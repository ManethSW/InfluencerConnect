<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        //### payments
        //
        //This is where the business have to make the payment according to the budget. Before they can proceed with the collaboration the business has to make an payment which will be stored in the system. Then when the collaboration is done the payment will be sent to the influencer hence why the multiple statuses.
        //
        //- id
        //- collaboration_id (fk collaborations id)
        //- payer_id (fk users id)
        //- reciever_id (fk users id)
        //- type
        //- amount
        //- status
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('collaboration_id')->constrained('collaborations');
            $table->foreignId('payer_id')->constrained('users');
            $table->foreignId('reciever_id')->constrained('users');
            $table->decimal('amount', 8, 2);
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
