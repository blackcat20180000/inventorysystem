<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Organization extends Model
{
    private $rules=array();
    protected $table = "organization";	
	
	 
	/** MainController@getNewsData  , AdminContrlooer@newsManagement
     * initial Data on News page
     * @param : pagination counter
     * @Return : Array News data by pagenation count
     */
	
	
	 /** AdminContrlooer@newsManagement
     * total news count
     * @param : no
     * @Return : return total news count
     */
	
	
	 
	/** MainController@newsDetail, AdminContrlooer@newsEdit
     * Get news detail data by news_id
     * @param : news_id
     * @Return:  news_id, imageData by news_id, newsData by news_id
     */ 

	
	
	
}
