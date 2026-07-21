import { useEffect, useState } from 'react';
import {
  Apple, ArrowDown, Check, ChevronRight, Crown, Download, Gamepad2,
  Heart, Menu, Play, RotateCcw, Sparkles, Users, X,
} from 'lucide-react';
import logo from '../../../../raja/assets/varalica-header-logo.png';
import king from '../../../../raja/assets/varalica-king.png';
import icon from '../../../../raja/assets/icon.png';
import impostor from '../../../../raja/assets/games/imposter.webp';
import truthDare from '../../../../raja/assets/games/istina-izazov.webp';
import rather from '../../../../raja/assets/games/would-u-rather.webp';
import twoHearts from '../../../../raja/assets/games/dva-srca.webp';
import bomb from '../../../../raja/assets/games/bomb.webp';
import never from '../../../../raja/assets/games/Nnever-have-i-ever.webp';
import word from '../../../../raja/assets/games/word.webp';
import music from '../../../../raja/assets/games/music.webp';

const APP_STORE_URL = import.meta.env.VITE_APP_STORE_URL || 'https://apps.apple.com/us/search?term=Varalica';
const PLAY_STORE_URL = import.meta.env.VITE_PLAY_STORE_URL || 'https://play.google.com/store/apps/details?id=varalica.qla.dev';

const games = [
  { title: 'Pronađi Varalicu', players: '3–12 igrača', color: '#f97316', image: impostor, live: true },
  { title: 'Istina ili izazov', players: '2–20 igrača', color: '#0ea5e9', image: truthDare, live: true },
  { title: 'Šta bi radije', players: '2–15 igrača', color: '#ef4444', image: rather, live: true },
  { title: 'Dva srca', players: 'Tačno 2 igrača', color: '#e11d48', image: twoHearts },
  { title: 'Ko ima bombu', players: '3–12 igrača', color: '#18181b', image: bomb },
  { title: 'Nikad nisam', players: '2–20 igrača', color: '#eab308', image: never },
  { title: 'Pogodi pojam', players: '2–12 igrača', color: '#db2777', image: word },
  { title: 'Disco izazov', players: '2–10 igrača', color: '#7c3aed', image: music },
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

function App() {
  const [menuOpen, setMenuOpen] = useState(false);
  const [showAll, setShowAll] = useState(false);
  const [scrolled, setScrolled] = useState(false);

  useEffect(() => {
    const onScroll = () => setScrolled(window.scrollY > 24);
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
    return () => window.removeEventListener('scroll', onScroll);
  }, []);

  useEffect(() => {
    document.body.style.overflow = menuOpen ? 'hidden' : '';
    return () => { document.body.style.overflow = ''; };
  }, [menuOpen]);

  const closeMenu = () => setMenuOpen(false);

  return (
    <main id="top">
      <header className={scrolled ? 'scrolled' : ''}>
        <Brand />
        <nav>
          <a href="#igre">Igre</a>
          <a href="#kako">Kako radi</a>
          <a href="#isprobaj">Isprobaj</a>
        </nav>
        <a className="header-cta" href="#preuzmi"><Download /> Preuzmi</a>
        <button className="menu-button" onClick={() => setMenuOpen(true)} aria-label="Otvori meni"><Menu /></button>
      </header>

      {menuOpen && <div className="mobile-menu">
        <button onClick={closeMenu} aria-label="Zatvori meni"><X /></button>
        <Brand />
        <nav><a onClick={closeMenu} href="#igre">Igre</a><a onClick={closeMenu} href="#kako">Kako radi</a><a onClick={closeMenu} href="#isprobaj">Isprobaj</a><a onClick={closeMenu} href="#preuzmi">Preuzmi</a></nav>
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
        <a className="scroll-cue" href="#igre"><ArrowDown /> skrolaj za igre</a>
      </section>

      <div className="marquee" aria-hidden="true"><div>{[0,1].map(group => <span key={group}>PRONAĐI VARALICU ✦ ISTINA ILI IZAZOV ✦ ŠTA BI RADIJE ✦ DVA SRCA ✦ KO IMA BOMBU ✦ </span>)}</div></div>

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
        <div className="download-copy"><span className="kicker light">PARTY U DŽEPU</span><h2>Uvijek spremna<br/>za igru.</h2><p>Preuzmi Varalicu i pretvori svako okupljanje u večer koju ćete prepričavati.</p><div className="store-buttons"><StoreButton store="apple" light/><StoreButton store="play" light/></div><div className="features"><span><Check /> Bez reklama usred runde</span><span><Check /> Nove igre i pitanja</span><span><Check /> Igrajte offline</span></div></div>
        <div className="phone-wrap">
          <div className="phone-glow" />
          <div className="phone"><div className="phone-island"/><img src={icon} alt="Varalica aplikacija"/><b>VARALICA</b><small>PARTY IGRE ZA RAJU</small><button>IGRAJ</button></div>
          <img className="download-cat" src={logo} alt="" />
        </div>
      </section>

      <section className="final-cta"><Heart fill="currentColor"/><h2>Ko donosi telefon?</h2><p>Ti. Ostali neka donesu dobre izgovore.</p><div className="store-buttons"><StoreButton store="apple"/><StoreButton store="play"/></div></section>

      <footer>
        <div className="footer-top"><Brand/><p>Jedan telefon.<br/>Cijela ekipa.</p><nav><a href="#igre">Igre</a><a href="#kako">Kako radi</a><a href="#preuzmi">Preuzmi</a></nav></div>
        <div className="footer-bottom"><span>© {new Date().getFullYear()} Varalica. Sva prava zadržana.</span><div><a href="mailto:hello@qla.dev">Kontakt</a><a href="#">Privatnost</a><a href="#">Uslovi korištenja</a></div></div>
      </footer>
    </main>
  );
}

export default App;
