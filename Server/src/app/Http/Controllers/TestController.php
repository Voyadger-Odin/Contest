<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use App\Models\TasksGroup;
use Dompdf\Css\Stylesheet;
use Dompdf\Dompdf;
use Dompdf\FontMetrics;
use Dompdf\Options;
use Illuminate\Support\Facades\Http;
use Barryvdh\DomPDF\Facade\Pdf;

class TestController extends Controller
{
    public function test()
    {
        $task = Tasks::find(20);
        $tests = json_decode($task->tests);

        $html = view('pdf.task-pdf', [
            'task' => $task,
            'maxtime' => $tests->maxtime,
            'memory_size' => $tests->memory_size,
        ])->render();

        //dd(public_path() . '/assets/fonts/SanFrancisco');
        $fontDirectory = public_path() . '/assets/fonts/SanFrancisco'; //change to the diretory where you fonts is located on your server
        $options = new Options();
        $options->setChroot($fontDirectory);

        /*
        [
            'enable_remote' => true,
        ]
        */

        $pdfCoder = new Dompdf([
            'enable_remote' => true,
        ]);

        // Регистрация шрифтов
        // you have to set the style (e.g. italic) and weight (e.g. bold) normal
        /*
        $pdfCoder->getFontMetrics()->registerFont(
            ['family' => 'SF UI Text', 'style' => 'normal', 'weight' => 'normal'],
            $fontDirectory . '/SFUIText-Regular.ttf'
        );
        */

        if (request('pdf')){
            $pdfCoder->loadHtml($html);
            $pdfCoder->setCss(new Stylesheet($pdfCoder));
            $pdfCoder->render();
            $pdfCoder->stream('', [
                'compress' => true,
                'Attachment' => false,
            ]);
        }

        return view('test');
    }
}
