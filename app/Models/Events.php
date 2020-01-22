<?php
namespace App\Models;

Use Simple\Model;
Use function Simple\QueryBuilder\field;

class Events extends Model
{
    /**
     * $table - table name using by this model
     *
     * @var string
     */
    protected $table = 'events';

    /**
     * Fillables - the columns in you $table 
     *
     * @var array
     */
    protected $fillable = ['id','title','start_event','end_event'];

    /**
     *  This is generated Events model.
     *  It is recommended that you put all queries here. 
     *  Create Something great!
     */

     public static function all()
     {
        $query = parent::factory()
        ->select()
        ->from('events')
        ->compile();
        return self::run($query,['fetch_mode'=>'assoc']);
     }

     public static function update($data)
     {
        $query = parent::factory()
        ->update('places', [
            'address' => '555 Money Ave'
        ])
        ->where(field('name')->eq('work'))
        ->compile();
        $query->sql(); 
     }

     public static function delete($id)
     {
         $query = parent::factory()
         ->delete('events')
         ->where(field('id')->eq($id))
         ->compile();

        return self::run($query);

     }

     public static function current()
     {
      $query = "SELECT * FROM `events` WHERE date_format(start_event,'%Y-%m-%d') = ? ORDER BY id";
      $stmt = self::DB()->prepare($query);
      $res = $stmt->execute([date('Y-m-d')]);
      return $stmt->fetchAll();
      
     }

}
