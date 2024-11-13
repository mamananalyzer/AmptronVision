<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('metering', function (Blueprint $table) {
            $table->id('id_metering');
            $table->string('project', 50)->nullable(); // Assuming a max length of 50 characters for text fields
            $table->string('section', 50)->nullable();
            $table->string('device', 50)->nullable();
            $table->string('sn', 50)->nullable();
            $table->enum('status', ['active', 'inactive'])->nullable(); // Use an enum if possible
            // Use smaller numeric types for numeric fields
            $table->string('F', 50)->nullable();
            $table->string('U1', 50)->nullable();
            $table->string('U2', 50)->nullable();
            $table->string('U3', 50)->nullable();
            $table->string('Uavg', 50)->nullable();
            $table->string('U12', 50)->nullable();
            $table->string('U23', 50)->nullable();
            $table->string('U31', 50)->nullable();
            $table->string('Ulavg', 50)->nullable();
            $table->string('IL1', 50)->nullable();
            $table->string('IL2', 50)->nullable();
            $table->string('IL3', 50)->nullable();
            $table->string('Iavg', 50)->nullable();
            $table->string('In', 50)->nullable();
            $table->string('Pa', 50)->nullable();
            $table->string('Pb', 50)->nullable();
            $table->string('Pc', 50)->nullable();
            $table->string('Psum', 50)->nullable();
            $table->string('Qa', 50)->nullable();
            $table->string('Qb', 50)->nullable();
            $table->string('Qc', 50)->nullable();
            $table->string('Qsum', 50)->nullable();
            $table->string('Sa', 50)->nullable();
            $table->string('Sb', 50)->nullable();
            $table->string('Sc', 50)->nullable();
            $table->string('Ssum', 50)->nullable();
            $table->string('PFa', 50)->nullable();
            $table->string('PFb', 50)->nullable();
            $table->string('PFc', 50)->nullable();
            $table->string('PFsum', 50)->nullable();
            $table->string('U_unbl', 50)->nullable();
            $table->string('I_unbl', 50)->nullable();
            $table->string('LCR', 50)->nullable();
            $table->string('P_Dmd', 50)->nullable();
            $table->string('Q_Dmd', 50)->nullable();
            $table->string('S_Dmd', 50)->nullable();
            $table->string('I1_Dmd', 50)->nullable();
            $table->string('I2_Dmd', 50)->nullable();
            $table->string('I3_Dmd', 50)->nullable();
            $table->string('Ep_Imp', 50)->nullable();
            $table->string('Ep_Exp', 50)->nullable();
            $table->string('Eq_Imp', 50)->nullable();
            $table->string('Eq_Exp', 50)->nullable();
            $table->string('Ep_sum', 50)->nullable();
            $table->string('Ep_net', 50)->nullable();
            $table->string('Eq_sum', 50)->nullable();
            $table->string('Eq_net', 50)->nullable();
            $table->string('Es', 50)->nullable();
            $table->string('Epa_Imp', 50)->nullable();
            $table->string('Epa_Exp', 50)->nullable();
            $table->string('Epb_Imp', 50)->nullable();
            $table->string('Epb_Exp', 50)->nullable();
            $table->string('Epc_Imp', 50)->nullable();
            $table->string('Epc_Exp', 50)->nullable();
            $table->string('Eqa_Imp', 50)->nullable();
            $table->string('Eqa_Exp', 50)->nullable();
            $table->string('Eqb_Imp', 50)->nullable();
            $table->string('Eqb_Exp', 50)->nullable();
            $table->string('Eqc_Imp', 50)->nullable();
            $table->string('Eqc_Exp', 50)->nullable();
            $table->string('Esa', 50)->nullable();
            $table->string('Esb', 50)->nullable();
            $table->string('Esc', 50)->nullable();
            $table->string('PhsAngV2toV1', 50)->nullable();
            $table->string('PhsAngV3toV1', 50)->nullable();
            $table->string('PhsAngI1toV1', 50)->nullable();
            $table->string('PhsAngI2toV1', 50)->nullable();
            $table->string('PhsAngI3toV1', 50)->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metering');
    }
};
