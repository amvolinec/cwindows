<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Offer extends Model
{

    use LogsActivity;

    protected $fillable = [
        "company_id",
        "client_id",
        "architect_id",
        "inquiry_date",
        "planed_date",
        "number",
        "order_number",
        "title",
        "pv",
        "area",
        "state_id",
        "info",
        "pipeline",
        "enquiry_channel",
        "klaes",
        "contract_date",
        "contract_nr",
        "total",
        "total_with_vat",
        "balance",
        "expenses",
        "cost",
        "sales_profit",
        "user_id",
        "delivery_address",
        "delivery_date",
        "comment",
        "manager_id",
        "received_id",
        "private",
        "description",
        "type_id",
        "profile_id",
        "maintenance_id",
        "partner",
        "chance",
        "editor_id",
        "material_id",
        "color_id",
        "materials",
        "squaring",
        "colors",
    ];

    protected static $logAttributes = [
        "company_id",
        "client_id",
        "architect_id",
        "inquiry_date",
        "planed_date",
        "number",
        "order_number",
        "title",
        "pv",
        "area",
        "state_id",
        "info",
        "pipeline",
        "enquiry_channel",
        "klaes",
        "contract_date",
        "contract_nr",
        "total",
        "total_with_vat",
        "balance",
        "expenses",
        "cost",
        "sales_profit",
        "user_id",
        "delivery_address",
        "delivery_date",
        "comment",
        "manager_id",
        "received_id",
        "private",
        "description",
        "type_id",
        "profile_id",
        "maintenance_id",
        "partner",
        "chance",
        "editor_id",
        "material_id",
        "color_id",
        "materials",
        "squaring",
        "colors",
    ];

    private $sources = [
        ['www', 'email', 'other']
    ];

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function architect()
    {
        return $this->belongsTo('App\Architect');
    }

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function editor()
    {
        return $this->belongsTo('App\User', 'editor_id', 'id');
    }

    public function color()
    {
        return $this->belongsTo('App\Color');
    }

    public function material()
    {
        return $this->belongsTo('App\Material');
    }
    public function manager()
    {
        return $this->belongsTo('App\User', 'manager_id', 'id');
    }

    public function state()
    {
        return $this->belongsTo('App\State');
    }

    public function positions()
    {
        return $this->hasMany('App\Position');
    }

    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }

    public function persons()
    {
        return $this->belongsToMany('App\Person');
    }

    public function maintenance()
    {
        return $this->belongsTo('App\Maintenance');
    }

    public function files()
    {
        return $this->hasMany('App\File');
    }

    public function setInquiryDateAttribute($value){
        $this->attributes['inquiry_date'] = empty($value) ? null : substr($value, 0, 10);
    }

    public function setPlanedDateAttribute($value){
        $this->attributes['planed_date'] = empty($value) ? null : substr($value, 0, 10);
    }

    public function setContractDateAttribute($value)
    {
        $this->attributes['contract_date'] = empty($value) ? null : substr($value, 0, 10);
    }

    public function setDeliveryDateAttribute($value)
    {
        $this->attributes['delivery_date'] = empty($value) ? null : substr($value, 0, 10);
    }

    public function getTotalWordsAttribute() {
        return $this->getSumWords((int)$this->total_with_vat);
    }

    public function getFractionAttribute() {
        $str = (string)$this->total_with_vat - floor($this->total_with_vat);
        return substr($str, 2);
    }

    public function getReceivedAttribute() {
        return $this->sources[(int)$this->received_id];
    }

    public function getSumWords($skaicius){

        if ( $skaicius < 0 || strlen( $skaicius ) > 9 ) return "";

        if ( $skaicius == 0 ) return 'nulis';

        $vienetai = array( '', 'vienas', 'du', 'trys', 'keturi', 'penki', 'šeši', 'septyni', 'aštuoni', 'devyni' );

        $niolikai = array( '', 'vienuolika', 'dvylika', 'trylika', 'keturiolika', 'penkiolika', 'šešiolika', 'septyniolika', 'aštuoniolika', 'devyniolika' );

        $desimtys = array( '', 'dešimt', 'dvidešimt', 'trisdešimt', 'keturiasdešimt', 'penkiasdešimt', 'šešiasdešimt', 'septyniasdešimt', 'aštuoniasdešimt', 'devyniasdešimt' );

        $pavadinimas = array(
            array( 'milijonas', 'milijonai', 'milijonų' ),
            array( 'tūkstantis', 'tūkstančiai', 'tūkstančių' ),
        );

        $skaicius = sprintf( '%09d', $skaicius ); // iki milijardu 10^9 (milijardu neskaiciuosim)
        $skaicius = str_split( $skaicius, 3 ); // kertam kas tris simbolius

        $zodziais = array();

        foreach ( $skaicius as $i => $tripletas ) {

            if ( $tripletas[0] > 0 ) {
                $zodziais[] = $vienetai[ $tripletas[0] ];
                $zodziais[] = ( $tripletas[0] > 1 ) ? 'šimtai' : 'šimtas';
            }

            $du = substr( $tripletas, 1 );

            if ( $du > 10 && $du < 20 ) {
                $zodziais[] = $niolikai[ $du[1] ];
                $linksnis = 2;
            } else {

                if ( $du[0] > 0 ) {
                    $zodziais[] = $desimtys[ $du[0] ];
                }

                if ( $du[1] > 0 ) {
                    $zodziais[] = $vienetai[ $du[1] ];
                    $linksnis = ( $du[1] > 1 ) ? 1 : 0;
                } else {
                    $linksnis = 2;
                }

            }

            if ( $i < count( $pavadinimas ) && $tripletas != '000' ) {
                $zodziais[] = $pavadinimas[ $i ][ $linksnis ];
            }

        }

        return implode( ' ', $zodziais );
    }
}
