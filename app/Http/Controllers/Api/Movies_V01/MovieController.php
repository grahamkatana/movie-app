<?php

namespace App\Http\Controllers\Api\Movies_V01;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MovieController extends Controller
{
   
    public function index(){
        $all= File::get(public_path().'/mock/database.json');

        $data=[];
        foreach(json_decode($all,true) as $result){
            $averageRatings=0;
            $genres='';
              //get elements in ratings to get the ratings:
              for($i=0;$i<count($result['ratings']);$i++){
                $averageRatings=$averageRatings+$result['ratings'][$i];


            }
            $genres='';
                 for($i=0;$i<count($result['genres']);$i++){
                    $genres=$genres.' | '.$result['genres'][$i];


                }

            //get filtered data into the array for usage later:
            $data[]=[
                'id'=>$result['id'],
                'title'=>$result['title'],
                'year'=>$result['year'],
                'ratingScore'=>round(($averageRatings/(count($result['ratings'])*10))*100,0),
                'genres'=>$genres,
                'ratings'=>$result['ratings'],
                'releaseDate'=>$result['releaseDate'],
                'storyline'=>$result['storyline'],
                'actors'=>$result['actors'],
                'posterurl'=>$result['posterurl']

        ];

        }
        return json_encode($data);

    }
    public function search($query){
        //load the mock database:
        $all= File::get(public_path().'/mock/database.json');
        $results=json_decode($all,TRUE);
        $data=[];

        $parameter='/'.$query.'/i';
        foreach($results as $result){
            if(preg_match_all($parameter,$result['title'])){
                $averageRatings=0;
                $genres='';


                //get elements in ratings to get the ratings:
                for($i=0;$i<count($result['ratings']);$i++){
                    $averageRatings=$averageRatings+$result['ratings'][$i];


                }
                for($i=0;$i<count($result['genres']);$i++){
                    $genres=$genres.' | '.$result['genres'][$i];


                }
                //get filtered data into the array for usage later:
                $data[]=[
                    'id'=>$result['id'],
                    'title'=>$result['title'],
                    'year'=>$result['year'],
                    'ratingScore'=>round(($averageRatings/(count($result['ratings'])*10))*100,0),
                    'genres'=>$genres,
                    'ratings'=>$result['ratings'],
                    'releaseDate'=>$result['releaseDate'],
                    'storyline'=>$result['storyline'],
                    'actors'=>$result['actors'],
                    'posterurl'=>$result['posterurl']

            ];

            }
        }
        //return the filtered results
        return json_encode($data);

    }
    public function show($id){
         //load the mock database:
         $all= File::get(public_path().'/mock/database.json');
         $results=json_decode($all,TRUE);
         $id=$id;
         $data=[];
         foreach($results as $result){
             if($result['id']==$id){
                 $averageRatings=0;
                 $genres='';
                 for($i=0;$i<count($result['genres']);$i++){
                    $genres=$genres.' | '.$result['genres'][$i];


                }


                 //get elements in ratings to get the ratings:
                 for($i=0;$i<count($result['ratings']);$i++){
                     $averageRatings=$averageRatings+$result['ratings'][$i];


                 }
                 //get filtered data into the array for usage later:
                 $data[]=[
                     'id'=>$result['id'],
                     'title'=>$result['title'],
                     'year'=>$result['year'],
                     'ratingScore'=>round(($averageRatings/(count($result['ratings'])*10))*100,0),
                     'genres'=>$genres,
                     'ratings'=>$result['ratings'],
                     'releaseDate'=>$result['releaseDate'],
                     'storyline'=>$result['storyline'],
                     'actors'=>$result['actors'],
                     'posterurl'=>$result['posterurl']

             ];

             }
         }
         //return the filtered results
         return json_encode($data);


    }
}
