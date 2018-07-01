<?php
/**
 * Created by PhpStorm.
 * User: brvchnko
 * Date: 7/1/18
 * Time: 8:04 PM
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LeagueController extends Controller
{

    public function createLeague()
    {


    }

    public function deleteLeague($id)
    {
        $em = $this->getDoctrine()->getManager();

        $league = $em->getRepository()->findOneById(['id' => $id]);


    }
}