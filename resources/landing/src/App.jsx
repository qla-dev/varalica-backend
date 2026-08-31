import { useEffect, useState } from 'react';
import {
  Apple, ArrowDown, Check, ChevronRight, Crown, Download, Gamepad2,
  Heart, Menu, Play, RotateCcw, Sparkles, Users, WifiOff, X,
} from 'lucide-react';
import logo from '../../../../raja/assets/varalica-header-logo.png';
import king from '../../../../raja/assets/varalica-king.png';
import crew from '../assets/varalica-ekipa.png';
import icon from '../../../../raja/assets/icon.png';
import impostor from '../../../../raja/assets/games/imposter.webp';
import truthDare from '../../../../raja/assets/games/istina-izazov.webp';
import rather from '../../../../raja/assets/games/would-u-rather.webp';
import twoHearts from '../../../../raja/assets/games/dva-srca.webp';
import bomb from '../../../../raja/assets/games/bomb.webp';
import never from '../../../../raja/assets/games/Nnever-have-i-ever.webp';
import word from '../../../../raja/assets/games/word.webp';
import music from '../../../../raja/assets/games/music.webp';
import qlaLogo from '../../../../../tap/public/images/logo-qla.png';

const DOWNLOAD_PATH = '/download';
const APP_STORE_URL = import.meta.env.VITE_APP_STORE_URL || 'https://apps.apple.com/app/varalica-imposter-igrica/id6784401796?l=hr';
const PLAY_STORE_URL = import.meta.env.VITE_PLAY_STORE_URL || 'https://play.google.com/store/apps/details?id=varalica.qla.dev';

function detectStorePlatform() {
  const userAgent = navigator.userAgent || '';
  const platform = navigator.platform || '';
  const isIpadOS = platform === 'MacIntel' && navigator.maxTouchPoints > 1;

  if (/Android/i.test(userAgent)) return 'android';
  if (/iPhone|iPad|iPod/i.test(userAgent) || isIpadOS) return 'ios';

  return null;
}

function storeUrl(platform) {
  return platform === 'ios' ? APP_STORE_URL : PLAY_STORE_URL;
}

const games = [
  { title: 'Pronađi Varalicu', players: '3–12 igrača', color: '#f97316', image: impostor, live: true },
  { title: 'Istina ili izazov', players: '2–20 igrača', color: '#0ea5e9', image: truthDare, live: true },
  { title: 'Šta bi radije', players: '2–15 igrača', color: '#ef4444', image: rather, live: true },
  { title: 'Dva srca', players: 'Tačno 2 igrača', color: '#e11d48', image: twoHearts },
  { title: 'Nikad nisam', players: '2–20 igrača', color: '#eab308', image: never },
  { title: 'Ko ima bombu', players: '3–12 igrača', color: '#18181b', image: bomb },
  { title: 'Pogodi pojam', players: '2–12 igrača', color: '#db2777', image: word },
  { title: 'Disco izazov', players: '2–10 igrača', color: '#7c3aed', image: music },
];

const gameGuides = [
  {
    title: 'Pronađi Varalicu', tag: 'Blef, tragovi i sumnjivi pogledi', image: impostor, accent: '#f97316',
    intro: 'Svi znaju tajnu riječ — osim Varalice. Hoće li se odati lošim tragom ili izvući čistim blefom?',
    rules: ['Odaberite broj igrača, Varalica, kategorije i trajanje runde.', 'Dodaj telefon svakom igraču da tajno vidi riječ ili svoju ulogu.', 'Redom dajte po jedan trag, bez izgovaranja tajne riječi.', 'Kad vrijeme istekne, svaki igrač zaključava svoj glas.', 'Aplikacija otkriva Varalicu i pobjednike runde.']
  },
  {
    title: 'Istina ili izazov', tag: 'Koliko dobro stvarno poznaješ raju?', image: truthDare, accent: '#0ea5e9',
    intro: 'Svaki potez donosi izbor: iskren odgovor ili izazov koji će ekipa još dugo prepričavati.',
    rules: ['Odaberite broj igrača i kategorije koje odgovaraju ekipi.', 'Aplikacija proziva igrača koji je na potezu.', 'Igrač bira Istinu ili Izazov i otkriva svoju karticu.', 'Odgovori iskreno ili izvrši izazov pred rajom.', 'Dodirni dalje — telefon i potez idu sljedećem igraču.']
  },
  {
    title: 'Šta bi radije', tag: 'Dva izbora. Nijedan normalan.', image: rather, accent: '#ef4444',
    intro: 'Brzi izbori postaju ozbiljne debate čim neko mora objasniti zašto je odabrao baš to.',
    rules: ['Odaberite igrače i jednu ili više kategorija pitanja.', 'Igrač na potezu naglas čita obje ponuđene opcije.', 'Odaberi jednu opciju — nema trećeg izlaza.', 'Pogledaj procenat i odbrani svoj izbor pred ekipom.', 'Predaj telefon sljedećem igraču za novi nemogući par.']
  }
];

const suspects = [
  { name: 'Miki', clue: 'More', emoji: '🌊', color: '#2563eb' },
  { name: 'Luna', clue: 'Plaža', emoji: '🏖️', color: '#ec4899' },
  { name: 'Roki', clue: 'Ljeto', emoji: '☀️', color: '#f97316' },
  { name: 'Bubi', clue: 'Toplo?', emoji: '😼', color: '#16a34a', impostor: true },
];

function StoreButton({ store, light = false }) {
  const apple = store === 'apple';
  return (
    <a className={`store-button ${light ? 'light' : ''}`} href={apple ? APP_STORE_URL : PLAY_STORE_URL} target="_blank" rel="noreferrer">
      {apple ? <Apple /> : <Play fill="currentColor" />}
      <span><small>PREUZMI ZA</small><strong>{apple ? 'App Store' : 'Google Play'}</strong></span>
    </a>
  );
}

function Brand() {
  return (
    <a className="brand" href="#top" aria-label="Varalica početna">
      <img src={logo} alt="" />
      <span>VARALICA</span>
    </a>
  );
}

function MiniGame() {
  const [choice, setChoice] = useState(null);
  const [revealed, setRevealed] = useState(false);

  const reset = () => {
    setChoice(null);
    setRevealed(false);
  };

  return (
    <div className="mini-game">
      <div className="mini-head">
        <div><span>BRZA RUNDA</span><h3>Ko je Varalica?</h3></div>
        <div className="secret"><small>TAJNA RIJEČ</small><b>MORE</b></div>
      </div>
      <p className="mini-prompt">Svi su dali trag. Jedan igrač ne zna riječ. Odaberi sumnjivca.</p>
      <div className="suspects">
        {suspects.map((suspect, index) => {
          const selected = choice === index;
          const status = revealed && suspect.impostor ? 'correct' : revealed && selected ? 'wrong' : '';
          return (
            <button className={`${selected ? 'selected' : ''} ${status}`} key={suspect.name} onClick={() => !revealed && setChoice(index)}>
              <i style={{ background: suspect.color }}>{suspect.emoji}</i>
              <b>{suspect.name}</b>
              <span>“{suspect.clue}”</span>
              {revealed && suspect.impostor && <em>VARALICA!</em>}
            </button>
          );
        })}
      </div>
      <div className="mini-actions">
        {!revealed ? (
          <button className="primary-button" disabled={choice === null} onClick={() => setRevealed(true)}>Zaključaj glas <ChevronRight /></button>
        ) : (
          <>
            <div className={`result ${suspects[choice]?.impostor ? 'win' : ''}`}>
              {suspects[choice]?.impostor ? 'Pogodak! Bubi je Varalica.' : 'Prevaren/a si — Bubi je Varalica.'}
            </div>
            <button className="icon-button" onClick={reset} aria-label="Ponovi"><RotateCcw /></button>
          </>
        )}
      </div>
    </div>
  );
}

const legalPages = {
  privacy: { title: 'Politika privatnosti', intro: 'Ovdje objašnjavamo koje podatke Varalica koristi i kako ih štitimo.', sections: [['Podaci koje koristimo', 'Za igranje nije potrebna registracija. Aplikacija može koristiti tehničke podatke potrebne za stabilan rad, kupovine i dijagnostiku grešaka.'], ['Kupovine i vanjske usluge', 'Apple, Google i RevenueCat mogu obrađivati podatke o kupovinama prema vlastitim pravilima privatnosti. Varalica ne prima podatke platnih kartica.'], ['Djeca i sigurnost', 'Kupovine trebaju izvršavati odrasle osobe ili djeca uz saglasnost roditelja ili staratelja.'], ['Kontakt', 'Za pitanja o privatnosti pišite na hello@qla.dev.']] },
  terms: { title: 'Uslovi korištenja', intro: 'Korištenjem Varalice prihvataš ove jednostavne uslove.', sections: [['Korištenje aplikacije', 'Varalica je party igra namijenjena privatnoj zabavi. Korisnik je odgovoran da igru i sadržaj koristi obzirno i u skladu sa zakonom.'], ['Digitalni sadržaj', 'Dostupnost igara i pitanja može se mijenjati kroz ažuriranja. Premium sadržaj i kupovine podliježu pravilima prodavnice preko koje su kupljeni.'], ['Intelektualno vlasništvo', 'Naziv, dizajn, ilustracije, kod i sadržaj Varalice pripadaju qla.dev-u i ne smiju se kopirati ili distribuirati bez dozvole.'], ['Kontakt', 'Za podršku ili pravna pitanja pišite na hello@qla.dev.']] },
  cookies: { title: 'Politika kolačića', intro: 'Varalica web stranica koristi samo ono što joj treba za pouzdan rad.', sections: [['Šta su kolačići', 'Kolačići su male tekstualne datoteke koje web stranica može sačuvati u pregledniku radi sigurnosti i tehničkog funkcionisanja.'], ['Neophodni kolačići', 'Možemo koristiti samo tehnički neophodne kolačiće za sigurnost, usmjeravanje i stabilan rad stranice.'], ['Analitika i oglasi', 'Trenutno ne koristimo oglasne kolačiće niti prodajemo podatke za oglašavanje.'], ['Mobilna aplikacija', 'Native iOS i Android aplikacija ne koristi web kolačiće za samo igranje. Vanjske platforme primjenjuju vlastita pravila.']] }
};

function LegalPage({ page }) {
  return <main className="legal-page"><header className="legal-header"><Brand /><a href="/">Nazad na početnu</a></header><section className="legal-hero"><span className="kicker">VARALICA · QLA.DEV</span><h1>{page.title}</h1><p>{page.intro}</p></section><section className="legal-content">{page.sections.map(([title, body], index) => <article key={title}><b>0{index + 1}</b><div><h2>{title}</h2><p>{body}</p></div></article>)}</section><footer className="legal-footer"><a className="qla-signature" href="https://qla.dev" target="_blank" rel="noreferrer"><span>Proizvod</span><img src={qlaLogo} alt="qla.dev" /></a><nav><a href="/privacy">Privatnost</a><a href="/terms">Uslovi korištenja</a><a href="/cookies">Kolačići</a></nav></footer></main>;
}

function App() {
  const [menuOpen, setMenuOpen] = useState(false);
  const [storeChoiceOpen, setStoreChoiceOpen] = useState(false);
  const [showAll, setShowAll] = useState(false);
  const [scrolled, setScrolled] = useState(false);

  useEffect(() => {
    const onScroll = () => setScrolled(window.scrollY > 24);
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
    return () => window.removeEventListener('scroll', onScroll);
  }, []);

  useEffect(() => {
    document.body.style.overflow = menuOpen || storeChoiceOpen ? 'hidden' : '';
    return () => { document.body.style.overflow = ''; };
  }, [menuOpen, storeChoiceOpen]);

  useEffect(() => {
    if (window.location.pathname.replace(/\/$/, '') !== DOWNLOAD_PATH) return;

    const platform = detectStorePlatform();

    if (platform) {
      window.location.replace(storeUrl(platform));
      return;
    }

    window.history.replaceState({}, '', '/');
    setStoreChoiceOpen(true);
  }, []);

  const chooseStore = (platform) => {
    setStoreChoiceOpen(false);
    window.location.href = storeUrl(platform);
  };

  const closeMenu = () => setMenuOpen(false);
  const legalPage = legalPages[window.location.pathname.replace(/^\//, '').replace(/\/$/, '')];

  if (legalPage) return <LegalPage page={legalPage} />;

  return (
    <main id="top">
      <header className={scrolled ? 'scrolled' : ''}>
        <Brand />
        <nav>
          <a href="#igre">Igre</a>
          <a href="#kako">Kako radi</a>
          <a href="#isprobaj">Isprobaj</a>
        </nav>
        <a className="header-cta" href={DOWNLOAD_PATH}><Download /> Preuzmi</a>
        <button className="menu-button" onClick={() => setMenuOpen(true)} aria-label="Otvori meni"><Menu /></button>
      </header>

      {menuOpen && <div className="mobile-menu">
        <button onClick={closeMenu} aria-label="Zatvori meni"><X /></button>
        <Brand />
        <nav><a onClick={closeMenu} href="#igre">Igre</a><a onClick={closeMenu} href="#kako">Kako radi</a><a onClick={closeMenu} href="#isprobaj">Isprobaj</a><a onClick={closeMenu} href={DOWNLOAD_PATH}>Preuzmi</a></nav>
      </div>}

      <section className="hero">
        <div className="hero-confetti" aria-hidden="true"><i/><i/><i/><i/><i/><i/></div>
        <div className="hero-copy">
          <div className="eyebrow"><Sparkles /> 8 IGARA. JEDAN TELEFON.</div>
          <h1>Ko laže<br/><em>najbolje?</em></h1>
          <p>Party igre za ekipu koja se zna — ili misli da se zna. Bez pripreme, bez kartica i bez dosadnih pravila.</p>
          <div className="hero-actions"><a className="primary-button" href="#igre">Biraj igru <ChevronRight /></a><a className="text-button" href="#isprobaj"><Play fill="currentColor" /> Isprobaj rundu</a></div>
          <div className="hero-proof"><div className="faces"><span>😼</span><span>😹</span><span>🙀</span></div><p><b>Za 2–20 igrača</b><small>Zabava počinje za 30 sekundi</small></p></div>
        </div>
        <div className="hero-art">
          <div className="sunburst" />
          <img className="hero-king" src={king} alt="Varalica mačak na kraljevskom tronu" />
          <div className="speech speech-one">Ja nisam! 😇</div>
          <div className="speech speech-two">Sumnjivo...</div>
          <div className="game-chip"><Crown /><span><small>VEČERAŠNJI KRALJ</small><b>Ko najbolje vara?</b></span></div>
        </div>
      </section>

      <div className="marquee" aria-hidden="true"><div>{[0,1].map(group => <span key={group}>PRONAĐI VARALICU ✦ ISTINA ILI IZAZOV ✦ ŠTA BI RADIJE ✦ DVA SRCA ✦ KO IMA BOMBU ✦ </span>)}</div></div>
      <a className="scroll-cue" href="#igre"><ArrowDown /> skrolaj za igre</a>

      <section className="games-section" id="igre">
        <div className="section-heading">
          <div><span className="kicker">IZABERI HAOS</span><h2>Za svaki tip<br/>ekipe.</h2></div>
          <p>Od tajnih uloga do neugodnih pitanja. Svaka igra ima svoja pravila, energiju i razlog za svađu.</p>
        </div>
        <div className="game-grid">
          {games.slice(0, showAll ? games.length : 6).map((game, index) => <article className={`game-tile tile-${index}`} key={game.title} style={{ '--accent': game.color }}>
            <img src={game.image} alt="" />
            <div className="tile-shade" />
            <div className="game-number">0{index + 1}</div>
            {game.live ? <span className="available"><i/> IGRAJ ODMAH</span> : <span className="soon">USKORO</span>}
            <div className="game-copy"><h3>{game.title}</h3><p><Users /> {game.players}</p></div>
          </article>)}
        </div>
        {!showAll && <button className="outline-button" onClick={() => setShowAll(true)}>Pokaži sve igre <ChevronRight /></button>}
      </section>

      <div className="game-guides" id="pravila">
        {gameGuides.map((guide, guideIndex) => (
          <section className={`guide-section ${guideIndex % 2 ? 'guide-reverse' : ''}`} key={guide.title} style={{ '--guide-accent': guide.accent }}>
            <div className="guide-visual">
              <span className="guide-index">0{guideIndex + 1}</span>
              <div className="guide-image-wrap"><img src={guide.image} alt={guide.title} /></div>
              <span className="guide-sticker">IGRAJ KAO RAJA</span>
            </div>
            <div className="guide-copy">
              <span className="kicker">KAKO SE IGRA</span>
              <h2>{guide.title}</h2>
              <p className="guide-tag">{guide.tag}</p>
              <p className="guide-intro">{guide.intro}</p>
              <ol>{guide.rules.map((rule, ruleIndex) => <li key={rule}><b>{ruleIndex + 1}</b><span>{rule}</span></li>)}</ol>
            </div>
          </section>
        ))}
      </div>

      <section className="how-section" id="kako">
        <div className="how-title"><span className="kicker">NEMA KOMPLIKACIJA</span><h2>Telefon na sto.<br/><em>Raja u krug.</em></h2></div>
        <div className="steps">
          <article><b>01</b><div className="step-icon red"><Gamepad2 /></div><h3>Izaberi igru</h3><p>Nađi raspoloženje večeri — smijeh, tajne, izazovi ili totalni haos.</p></article>
          <article><b>02</b><div className="step-icon orange"><Users /></div><h3>Okupi ekipu</h3><p>Dodaj igrače i proslijedi telefon. Nema registracije ni posebne opreme.</p></article>
          <article><b>03</b><div className="step-icon yellow"><Crown /></div><h3>Otkrij Varalicu</h3><p>Igra vodi rundu, a vi pokušavate nadmudriti jedni druge. Najbolji blefer pobjeđuje.</p></article>
        </div>
      </section>

      <section className="try-section" id="isprobaj">
        <div className="try-copy"><span className="kicker">NE VJERUJ NIKOME</span><h2>Možeš li je<br/>prepoznati?</h2><p>Probaj mini rundu igre <b>Pronađi Varalicu</b>. Svi osim jednog igrača znaju tajnu riječ.</p><div className="try-note"><span>💡</span><p><b>Mali savjet</b><br/>Najopasnija Varalica daje trag dovoljno blizu da zvuči uvjerljivo.</p></div></div>
        <MiniGame />
      </section>

      <section className="download-section" id="preuzmi">
        <div className="download-copy">
          <span className="kicker light">PARTY U DŽEPU</span>
          <h2>Uvijek spremna<br/>za igru.</h2>
          <p>Preuzmi Varalicu i pretvori svako okupljanje u večer koju ćete prepričavati.</p>
          <div className="access-modes">
            <article><WifiOff /><span><b>Radi i bez interneta</b><small>Lokalne igre i kategorije uvijek su dostupne offline.</small></span></article>
            <article className="king-access"><Crown /><span><b>KING Pro otključava online</b><small>Sav online sadržaj, nove kategorije i budući dodaci.</small></span></article>
          </div>
          <div className="store-buttons"><StoreButton store="apple" light/><StoreButton store="play" light/></div>
          <div className="features"><span><Check /> Bez reklama usred runde</span><span><Check /> Bez registracije</span><span><Check /> Igrajte offline</span></div>
        </div>
        <div className="phone-wrap">
          <div className="phone-glow" />
          <div className="phone"><div className="phone-island"/><img src={icon} alt="Varalica aplikacija"/><b>VARALICA</b><small>PARTY IGRE ZA RAJU</small><button>IGRAJ</button></div>
          <img className="download-cat" src={logo} alt="" />
        </div>
      </section>

      <section className="final-cta">
        <div className="final-cta-copy"><Heart fill="currentColor"/><span className="kicker">OKUPI EKIPU</span><h2>Ko donosi telefon?</h2><p>Ti. Ostali neka donesu dobre izgovore.</p><div className="store-buttons"><StoreButton store="apple"/><StoreButton store="play"/></div></div>
        <div className="final-crew"><span>RAJA JE SPREMNA!</span><img src={crew} alt="Četiri Varalica mačka spremna za igru" /></div>
      </section>

      <footer>
        <div className="footer-top"><Brand/><p>Jedan telefon.<br/>Cijela ekipa.</p><nav><a href="#igre">Igre</a><a href="#kako">Kako radi</a><a href={DOWNLOAD_PATH}>Preuzmi</a></nav></div>
        <div className="footer-bottom"><span>© {new Date().getFullYear()} Varalica. Sva prava zadržana.</span><a className="qla-signature" href="https://qla.dev" target="_blank" rel="noreferrer"><span>Proizvod</span><img src={qlaLogo} alt="qla.dev" /></a><div><a href="mailto:hello@qla.dev">Kontakt</a><a href="/privacy">Privatnost</a><a href="/terms">Uslovi korištenja</a><a href="/cookies">Kolačići</a></div></div>
      </footer>

      {storeChoiceOpen && <div className="store-modal" role="dialog" aria-modal="true" aria-labelledby="store-modal-title" onClick={() => setStoreChoiceOpen(false)}>
        <div className="store-modal-card" onClick={(event) => event.stopPropagation()}>
          <button className="store-modal-close" onClick={() => setStoreChoiceOpen(false)} aria-label="Zatvori"><X /></button>
          <div className="store-modal-icon"><Download /></div>
          <h2 id="store-modal-title">Preuzmi Varalicu</h2>
          <p>Odaberi platformu za svoj telefon.</p>
          <div className="store-modal-actions">
            <button onClick={() => chooseStore('ios')}><Apple /> iOS</button>
            <button onClick={() => chooseStore('android')}><Play fill="currentColor" /> Android</button>
          </div>
        </div>
      </div>}
    </main>
  );
}

export default App;
