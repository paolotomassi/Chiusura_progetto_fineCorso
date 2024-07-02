<?php

namespace App\Jobs;

use App\Models\Image;
use Illuminate\Bus\Queueable;
use Spatie\Image\Manipulations;
use Illuminate\Queue\SerializesModels;
use Spatie\Image\Image as SpatieImage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;

class RemoveFaces implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $article_img_id;

    /**
     * Create a new job instance.
     * 
     *     @return void
     */
    public function __construct($article_img_id)
    {
        $this->article_img_id = $article_img_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $i = Image::find($this->article_img_id);
        if (!$i) {
            return;
        }
        
        $srcPath= storage_path('app/public/'. $i->path);
        $image =file_get_contents($srcPath);

        //impostare la variabile d'ambiente GOOGLE_APPLICATION_CREDENTIALS al path del credentials file
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . base_path('google_credential.json'));

        // https://cloud.google.com/vision/docs/detecting-faces?hl=it

        $imageAnnotator = new ImageAnnotatorClient();
        $response = $imageAnnotator-> faceDetection($image);
        $faces= $response->getFaceAnnotations();

        foreach ($faces as $face) {
            $vertices= $face->getBoundingPoly()->getVertices();

            $bounds=[];

            //ARRAY DI 4 ARRAY, CON POSIZIONE [120, 120] IN px. Rappresenta il quadrato che si va a formare sulla faccia che l'intelligenza artificiale di google va a trovare.
            foreach ($vertices as $vertex) {
                $bounds[]=[$vertex->getX(), $vertex->getY()];
            }
            //queste sono le dimensioni che si basano sulla sottrazione degli angoli:
            //[120, 120]
            //[120, 120]
            //[120, 120]
            //[120, 120]
            //w=angolo in alto a sx-angolo in alto a dx
            $w=$bounds[2][0]-$bounds[0][0];
            $h=$bounds[2][1]-$bounds[0][1];

            $image=SpatieImage::load($srcPath);

        //modifica dell'immagine
            $image->watermark(base_path('resources/img/smile.png'))
                ->watermarkPosition('top-left')
                ->watermarkPadding($bounds[0][0], $bounds[0][1])
                ->watermarkWidth($w, Manipulations::UNIT_PIXELS)
                ->watermarkHeight($h, Manipulations::UNIT_PIXELS)
                ->watermarkFit(Manipulations::FIT_STRETCH);
                
            $image->save($srcPath);
        }
        $imageAnnotator->close();
        


    }
}
