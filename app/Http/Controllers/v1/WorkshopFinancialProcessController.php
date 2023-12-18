<?php

namespace App\Http\Controllers\v1;
use App\Models\WorkshopFinancialProcess;
use Illuminate\Routing\Controller;

use Illuminate\Http\Request;

class WorkshopFinancialProcessController extends Controller
{


//        Schema::create( 'workshop_financial_processes', function (Blueprint $table) {
//            $table->id();
//            $table->foreignId('workshop_id');
//            $table->decimal('price_per_hour_and_cup', 10, 2)->nullable();
//            $table->decimal('rate_per_hour_and_cup', 10, 2)->nullable();
//            $table->decimal('total_amount', 10, 2);
//            $table->timestamps();




    public function index(Request $request)
    {

        $current_page = $request->input('page', 1);
        $limit = $request->input('limit', 2);


        $financial = WorkshopFinancialProcess::query()
            ->paginate($limit, ['id', 'amount', 'created_at'], "page", $current_page)
            ->items();

        return ['data' => $financial];
    }


}
