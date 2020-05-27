<?php

namespace App\Presenters;

use App\Transformers\AnimalsTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AnimalsPresenter.
 *
 * @package namespace App\Presenters;
 */
class AnimalsPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AnimalsTransformer();
    }
}
