<?php

namespace App\Services;

use App\Repositories\PropertyRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class FilterProperties
{
    public Builder $query;

    public function __construct(public PropertyRepository $propertyRepository)
    {
        $this->query = $this->propertyRepository->getNewQuery();
    }

    /**
     * @param Request $request
     * @return Builder
     */
    public function handle(Request $request): Builder
    {
        if ($request->filled('type')) {
            $this->query->where('type_id', '=', $request->get('type'));
        }

        if(request()->filled('subtype')) {
            $this->query->where('subtype_id', '=',$request->get('subtype'));
        }

        if(request()->filled('region')) {
            $this->query->where('region_id', '=',$request->get('region'));
        }

        if(request()->filled('order_by')) {
            if( $request->get('order_by') === 'price_asc') {
                $this->query->orderBy('price', 'asc');
            }

            if( $request->get('order_by') === 'price_desc') {
                $this->query->orderBy('price', 'desc');
            }

            if( $request->get('order_by') === 'latest') {
                $this->query->orderBy('created_at', 'desc');
            }
        }

        if(request()->filled('price')) {
            $this->query->where('region_id', $request->get('subtype'));
        }

        return $this->query;
    }
}
