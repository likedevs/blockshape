<?php

namespace App\Services;

use App\Services\Contracts\DocumentBuilder as DocumentBuilderContract;
use App\User;
use App\UserHistory;
use Carbon\Carbon;
use Illuminate\Filesystem\Filesystem;
use PDFConverter;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Html;
use SplFileInfo;


/**
 * Class PdfBuilder
 *
 * @package App\Services
 */
class MsWordBuilder implements DocumentBuilderContract
{

    /**
     * @var DocumentBuilder
     */
    private $builder;
    /**
     * @var Filesystem
     */
    private $filesystem;


    /**
     * PdfBuilder constructor.
     *
     * @param DocumentBuilderContract $builder
     */
    public function __construct(DocumentBuilderContract $builder, Filesystem $filesystem)
    {
        $this->builder = $builder;
        $this->filesystem = $filesystem;

        $this->path = rtrim(config('builder.path'), '/');
    }

    /**
     * @param User        $user
     * @param UserHistory $record
     * @return string
     */
    public function build(User $user, UserHistory $record)
    {
        $document = $this->builder->build($user, $record);

        $writers = array('Word2007' => 'docx', 'ODText' => 'odt', 'RTF' => 'rtf', 'HTML' => 'html', 'PDF' => 'pdf');

        $phpWord = new PhpWord();

        $section = $phpWord->addSection();

        Html::addHtml($section, $document, true);

        foreach ($writers as $format => $extension) {
            $fileName = ("unicasport_{$user->sluggify()}_{$record->sluggify()}.{$extension}");
            $phpWord->save($this->path . '/' . $fileName, $format);
        }

//        $this->filesystem->put(
//            $this->path . '/' . ($fileName = ("unicasport_{$user->sluggify()}_{$record->sluggify()}.doc")),
//            $document
//        );

        return ($fileName);
    }
}