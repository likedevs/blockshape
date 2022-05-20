<?php

namespace App\Services\Contracts;

interface PdfBuilder
{
    /**
     * Convert a HTML document to PDF
     *
     * @param $htmlDocument
     * @return mixed
     */
    public function build($htmlDocument);
}