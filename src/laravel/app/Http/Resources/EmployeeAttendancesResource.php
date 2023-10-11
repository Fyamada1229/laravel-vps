<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeAttendancesResource extends JsonResource
{
    public static $wrap = 'employee_attendance';

    /** Jsonに出力するリレーション */
    public $with = [];

    /** Jsonに出力するアクセサ */
    protected $appends = [];

    /** Jsonに出力する項目 */
    protected $visible = [];

    /* Jseonから除外する項目 */
    protected $hidden = [];


    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
