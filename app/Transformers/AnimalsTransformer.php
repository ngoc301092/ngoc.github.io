<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Animals;

/**
 * Class AnimalsTransformer.
 *
 * @package namespace App\Transformers;
 */
class AnimalsTransformer extends TransformerAbstract
{
    /**
     * Transform the Animals entity.
     *
     * @param \App\Entities\Animals $model
     *
     * @return array
     */
    public function transform(Animals $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
