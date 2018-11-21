<?php

namespace HostAndGuestBundle\Controller;

use HostAndGuestBundle\Entity\experience;
use HostAndGuestBundle\Entity\jaime;
use HostAndGuestBundle\Entity\User;
use HostAndGuestBundle\Form\experienceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Finder\Finder;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Ob\HighchartsBundle\Highcharts\Highchart;
class experienceController extends Controller
{

    public function indexAction()
    {
        return $this->render('@HostAndGuest/experience/helli.html.twig');
    }
    public function FrontAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();


        $query = $em->createQuery(
            'SELECT  p
    FROM HostAndGuestBundle:experience p
    ORDER BY p.datecreation DESC '


        );;
        $catt = $query->GetResult();

        $m=$em->getRepository(experience::class)->FindAll();

        if ($request->isMethod('POST')) {

            $titre = $request->get('titre');

$date = $request->get('date');
$categorie=  $request->get('categorie');

            $lieu = $request->get('lieu');

            $em = $this->getDoctrine()->getManager();
            $query2 = $em->createQuery(
                'SELECT  p
    FROM HostAndGuestBundle:experience p
    WHERE p.lieu = :hurmoniste or p.titre  = :titre or p.date =:moment or p.categorie =:cat'
            )->setParameter('hurmoniste', $lieu
            )
                ->setParameter('titre', $titre
                )
                ->setParameter('moment',  $date
                )
                ->setParameter('cat',  $categorie
                )
            ;;
            $modeles = $query2->GetResult();

            return $this->render('@HostAndGuest/experience/searchtwig.html.twig',array("modeles"=>$modeles));
        }
        return $this->render('HostAndGuestBundle:experience:FrontOffice.html.twig',array("modeles"=>$catt));
    }
    public function ListeExAction()
    {


        return $this->render('@HostAndGuest/experience/ListeExperience.html.twig');
    }
    public function addExAction(Request $request)
    {
        $spec= new experience();

        $form=$this->createForm(experienceType::class,$spec);

        $form->handleRequest($request);
        $vr= 0;


        if ($form->isValid())
        {

            $file=$form['images']->getData();
            $name=$file->GetClientOriginalName();
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
            $spec->setUser($user);
            $spec->setImages($name
            );
            $now = new \Datetime();
            $spec->setDatecreation($now);
            $em = $this->getDoctrine()->getManager();



          if ($spec->getDate()< $now) {
          $this->get('session')->getFlashBag()->add(
        'notice',
        'Date invalide'
                      );
          $vr=$vr+1;
          return $this->render('@HostAndGuest/experience/ajoutex.html.twig',array('ajout'=>$form->createView(),'vr'=>
        $vr));
}
           else{
               $em->persist($spec);
               $em->flush();
            return $this->redirectToRoute('FrontOffice');}

            }

        return $this->render('@HostAndGuest/experience/ajoutex.html.twig',array('ajout'=>$form->createView(),'vr'=>
        $vr));
    }
    public function UserxAction()
    {
        return $this->render('HostAndGuestBundle:experience:WelcomeFrontOffice.html.twig');
    }
    public function BackAction()
    {
        return $this->render('@HostAndGuest/experience/Backoffice.html.twig');
    }

    public function ExperienceAction()
    {
        $user = new User();
        $user = $this->container->get('security.token_storage')->getToken()->getUser();

$id=$user->GetId();


        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT  p
    FROM HostAndGuestBundle:experience p
    WHERE p.user = :hurmoniste'

        )->setParameter('hurmoniste', $id
        );;
        $modeles = $query->GetResult();

        return $this->render('HostAndGuestBundle:experience:CustonExperience.html.twig',array("modeles"=>$modeles));
    }

    public function DeleteAction(Request $request,$id)
    {

        $em = $this->getDoctrine()->getManager();
        $modl=$em->getRepository("HostAndGuestBundle:experience")->find($id);
        $em->remove($modl);
        $em->flush();

        return $this->redirectToRoute('ExperienceCustom');
    }

    public function ExperiencePersonnaliséAction()
    {
        $user = new User();
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $cat=$user->Getcategorie();
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT  p
    FROM HostAndGuestBundle:experience p
    WHERE p.categorie = :hurmoniste'
        )->setParameter('hurmoniste', $cat
        );;
        $modeles = $query->GetResult();

        return $this->render('HostAndGuestBundle:experience:CategorieExperience.html.twig',array("modeles"=>$modeles));
    }
   public function displaySingleAction($id)
   {
       $em = $this->getDoctrine()->getManager();
       $m=$em->getRepository(experience::class)->find($id);
$user=$m->getUser()->getUsername();
       $userco = $this->container->get('security.token_storage')->getToken()->getUser();


       $query = $em->createQuery(
           'SELECT   count(p) 
    FROM HostAndGuestBundle:jaime p
    WHERE p.user = :hurmoniste AND p.experience=:experience'
       )->setParameter('hurmoniste', $userco)
           ->setParameter('experience', $m
       );;
       $count2 = $query ->getSingleScalarResult();

       $vr=0;
       if ($count2>0)
       {
$vr=1;

       }

       return $this->render('HostAndGuestBundle:experience:ConsulterEx.html.twig',array("modele"=>$m,"username"=>$user,"vr"=>$vr));

   }
 public function JaimeAction($id)
 {
$aime=new jaime();
     $em = $this->getDoctrine()->getManager();
     $user = $this->container->get('security.token_storage')->getToken()->getUser();
     $modl=$em->getRepository("HostAndGuestBundle:experience")->find($id);
     $nbr=$modl->getNb();
     $modl->setNb($nbr+1);
     $aime->setExperience($modl);
     $aime->setUser($user);
     $em->persist($modl);
     $em->flush();

     $em->persist($aime);
     $em->flush();

     return $this->redirectToRoute('CustomDisplay',array('id'=>$id));
 }
  public function TopexperienceAction()
  {
      $em = $this->getDoctrine()->getManager();
      $query = $em->createQuery(
          'SELECT  p
    FROM HostAndGuestBundle:experience p
   ORDER BY p.nb DESC'
      );;

      $modeles = $query->GetResult();

      return $this->render('@HostAndGuest/experience/top.html.twig',array("modeles"=>$modeles));
  }

  public function ModifyExAction(Request $request,$id)
  {
      $spec = new experience();
      $em = $this->getDoctrine()->getManager();
      $spec = $em->getRepository("HostAndGuestBundle:experience")->find($id);
      $form = $this->createForm(experienceType::class, $spec);

      $form->handleRequest($request);

      $vr=0;
      if ($form->isValid()) {




          $file = $form['images']->getData();
          $name = $file->GetClientOriginalName();


          $user = $this->container->get('security.token_storage')->getToken()->getUser();
          $spec->setUser($user);
          $spec->setImages($name
          );


          $em = $this->getDoctrine()->getManager();
          $em->persist($spec);
          $em->flush();
          return $this->redirectToRoute('FrontOffice');


      }
      return $this->render('@HostAndGuest/experience/ajoutex.html.twig',array('ajout'=>$form->createView(),'vr'=>
          $vr));
  }
public function ExpBackofficeAction()
{
    $em = $this->getDoctrine()->getManager();
    $m=$em->getRepository(experience::class)->FindAll();

    return $this->render('@HostAndGuest/experience/experiencebackoffice.html.twig',array("modeles"=>$m));

}
public function EffacerAction(Request $request,$id)
{ var_dump($id);
    $em = $this->getDoctrine()->getManager();
    $modl=$em->getRepository("HostAndGuestBundle:experience")->find($id);
    $em->remove($modl);
    $em->flush();
    return $this->redirectToRoute('displaybackofficeexp');

}
public function StatVilleAction()
{

    $ob = new Highchart();
    $ob->chart->renderTo('linechart');
    $ob->title->text('Expérience par ville');
    $ob->plotOptions->pie(array(
        'allowPointSelect'  => true,
        'cursor'    => 'pointer',
        'dataLabels'    => array('enabled' => false),
        'animation'=>true,
        'selected'=>true,
        'dataLabels' => array(
            'enabled' => true,
            'format' => '{point.name}: {point.y:.1f}'),
        'showInLegend'  => true

    ));


    $data=array();
    $em = $this->getDoctrine()->getManager();


    $query = $em->createQuery(
        'SELECT   count(p.lieu) as AA
    FROM HostAndGuestBundle:experience p
    WHERE p.lieu = :hurmoniste'
    )->setParameter('hurmoniste', 'Paris'
    );;
    $count2 = $query->getResult();
    foreach ($count2 as $values)
    {
        $paris=array('Paris',intval($values['AA']));
        array_push($data,$paris);
    }


    $query1 = $em->createQuery(
        'SELECT   count(p.lieu) as NewYork
    FROM HostAndGuestBundle:experience p
    WHERE p.lieu = :hurmoniste'
    )->setParameter('hurmoniste', 'New York'
    );;
    $count3 = $query1->getResult();

    foreach ($count3 as $values)
    {
        $newYork=array('NewYork',intval($values['NewYork']));
        array_push($data,$newYork);
    }





    $query2 = $em->createQuery(
        'SELECT   count(p.lieu) as Tunis
    FROM HostAndGuestBundle:experience p
    WHERE p.lieu = :hurmoniste'
    )->setParameter('hurmoniste', 'Tunis'
    );;

    $count4 = $query2->getResult();


    foreach ($count4 as $values)
    {
        $Tunis=array('Tunis',intval($values['Tunis']));
        array_push($data,$Tunis);
    }



    $query3 = $em->createQuery(
        'SELECT   count(p.lieu) as Rome
    FROM HostAndGuestBundle:experience p
    WHERE p.lieu = :hurmoniste'
    )->setParameter('hurmoniste', 'Rome'
    );;

    $count5 = $query3->getResult();


    foreach ($count5 as $values)
    {
        $Rome=array('Rome',intval($values['Rome']));
        array_push($data,$Rome);
    }





    $ob->series(array(array('type' => 'pie','name' => 'Expériences', 'data' => $data)));
    return $this->render('HostAndGuestBundle:experience:Piechart.html.twig', array(
        'chart' => $ob));
}

public function CategorieStatAction()
{
    $em = $this->getDoctrine()->getManager();



    $query = $em->createQuery(
        'SELECT   count(p.categorie) as Rome
    FROM HostAndGuestBundle:experience p
    WHERE p.categorie = :hurmoniste'
    )->setParameter('hurmoniste', 'sport'
    );;
    $count1 = $query->getResult();
    foreach ($count1 as $values)
    {
        $Rome=array(intval($values['Rome']));

    }



    $query2 = $em->createQuery(
        'SELECT   count(p.categorie) as culture
    FROM HostAndGuestBundle:experience p
    WHERE p.categorie = :hurmoniste'
    )->setParameter('hurmoniste', 'culture'
    );;
    $count2 = $query2->getResult();
    foreach ($count2 as $values)
    {
        $culture=array(intval($values['culture']));

    }



    $query3 = $em->createQuery(
        'SELECT   count(p.categorie) as diver
    FROM HostAndGuestBundle:experience p
    WHERE p.categorie = :hurmoniste'
    )->setParameter('hurmoniste', 'divertisement'
    );;
    $count3 = $query3->getResult();
    foreach ($count3 as $values)
    {
        $diver=array(intval($values['diver']));

    }


    $query4 = $em->createQuery(
        'SELECT   count(p.categorie) as autres
    FROM HostAndGuestBundle:experience p
    WHERE p.categorie = :hurmoniste'
    )->setParameter('hurmoniste', 'autres'
    );;
    $count4 = $query4->getResult();
    foreach ($count4 as $values)
    {
        $autre=array(intval($values['autres']));
    }

    $sellsHistory = array(
        array(
            "name" => "Expériences",
            "data" => array($Rome, $culture, $diver, $autre)
        )


    );

    $categorie = array(
        "Sport", "Culture", "Divertisement", "Autres"
    );

    $ob = new Highchart();
    // ID de l'élement de DOM que vous utilisez comme conteneur
    $ob->chart->renderTo('barchart');
    $ob->title->text('Expérience par Catégories');
    $ob->chart->type('bar');

    $ob->yAxis->title(array('text' => "Expériences"));

    $ob->xAxis->title(array('text' => "Categories"));
    $ob->xAxis->categories($categorie);

    $ob->series($sellsHistory);

    return $this->render('@HostAndGuest/experience/categoriestat.html.twig', array(
        'chart' => $ob
    ));


}

public function DashBordAction()
{

    return $this->render('@HostAndGuest/experience/Dashbord.html.twig.'
    );
}

public function AdminAction()
{
    $user = $this->container->get('security.token_storage')->getToken()->getUser();
var_dump($user);
$id=$user->GetId();
    $role = array('ROLE_ADMIN');
    $em = $this->getDoctrine()->getManager();
    $modl=$em->getRepository(User::class)->find($id);
    $modl->setRoles($role);
    $em->persist($modl
    );
    $em->flush();
    return new Response("ADMIN CREE");

}

public function JaimeplusAction($id)
{
    $em = $this->getDoctrine()->getManager();
    $userco = $this->container->get('security.token_storage')->getToken()->getUser();
    $experience=$em->getRepository("HostAndGuestBundle:experience")->find($id);

     $nbr=$experience->getNb();
     $experience->setNb($nbr-1);
    $em->persist($experience);
    $em->flush();

    $query = $em->createQuery(
        'SELECT   p.id
    FROM HostAndGuestBundle:jaime p
    WHERE p.user = :hurmoniste AND p.experience=:experience'
    )->setParameter('hurmoniste', $userco)
        ->setParameter('experience', $experience
        );;
    $jaime = $query  ->getSingleScalarResult();
    var_dump($jaime);
    $jaimeee=$em->getRepository(jaime::class)->find($jaime);
    $em->remove($jaimeee);
    $em->flush();

    return $this->redirectToRoute('CustomDisplay',array('id'=>$id));


}

}
