<?php

namespace Tests\Feature;

use Tests\TestCase;

class StorefrontLegalTest extends TestCase
{
    public function test_apple_download_redirects_to_the_app_store(): void
    {
        $this->get('/apple-download')->assertRedirect(
            'https://apps.apple.com/us/app/varalica-imposter-igrica/id6784401796'
        );
    }

    public function test_legal_pages_are_available(): void
    {
        foreach (['privacy', 'terms', 'cookies'] as $page) {
            $this->get('/'.$page)
                ->assertOk()
                ->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        }
    }

    public function test_built_storefront_contains_footer_and_legal_content(): void
    {
        $bundlePath = glob(public_path('dist/assets/index-*.js'))[0] ?? null;

        $this->assertNotNull($bundlePath);
        $bundle = file_get_contents($bundlePath);

        $this->assertStringContainsString('qla.dev', $bundle);
        $this->assertStringContainsString('Politika privatnosti', $bundle);
        $this->assertStringContainsString('Uslovi korištenja', $bundle);
        $this->assertStringContainsString('Politika kolačića', $bundle);
        $this->assertStringContainsString('/apple-download', $bundle);
    }
}
