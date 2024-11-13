<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metering extends Model
{
    use HasFactory;

    protected $table = 'metering';
    protected $primaryKey = 'id_metering';
    protected $fillable = [
        'project', 'section', 'device', 'sn', 'status',
        'F', 'U1', 'U2', 'U3', 'Uavg', 'U12', 'U23', 'U31', 'Ulavg',
        'IL1', 'IL2', 'IL3', 'Iavg', 'In', 'Pa', 'Pb', 'Pc', 'Psum',
        'Qa', 'Qb', 'Qc', 'Qsum', 'Sa', 'Sb', 'Sc', 'Ssum',
        'PFa', 'PFb', 'PFc', 'PFsum', 'U_unbl', 'I_unbl', 'LCR',
        'P_Dmd', 'Q_Dmd', 'S_Dmd', 'I1_Dmd', 'I2_Dmd', 'I3_Dmd',
        'Ep_Imp', 'Ep_Exp', 'Eq_Imp', 'Eq_Exp', 'Ep_sum', 'Ep_net',
        'Eq_sum', 'Eq_net', 'Es', 'Epa_Imp', 'Epa_Exp', 'Epb_Imp',
        'Epb_Exp', 'Epc_Imp', 'Epc_Exp', 'Eqa_Imp', 'Eqa_Exp',
        'Eqb_Imp', 'Eqb_Exp', 'Eqc_Imp', 'Eqc_Exp', 'Esa', 'Esb',
        'Esc', 'PhsAngV2toV1', 'PhsAngV3toV1', 'PhsAngI1toV1',
        'PhsAngI2toV1', 'PhsAngI3toV1', 'project', 'section',
        'device', 'sn', 'status',
    ];

    public $timestamps = true;
}
