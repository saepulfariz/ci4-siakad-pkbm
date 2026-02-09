<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Seo extends Controller
{
    public function sitemap()
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        $xml .= '<url>
            <loc>' . base_url('/') . '</loc>
            <lastmod>2026-02-08</lastmod>
        </url>';

        $xml .= '<url>
            <loc>' . base_url('/login') . '</loc>
            <lastmod>2026-02-08</lastmod>
        </url>';

        $xml .= '</urlset>';

        return $this->response
            ->setContentType('application/xml')
            ->setBody($xml);
    }

    public function robots()
    {
        $robots = "User-agent: *\n";
        $robots .= "Allow: /\n";
        $robots .= "Sitemap: " . base_url('sitemap.xml');

        return $this->response
            ->setContentType('text/plain')
            ->setBody($robots);
    }
}
