<?php

namespace App\Controller;

use App\Entity\Menu;
use App\Form\MenuType;
use App\Repository\MenuRepository;
use App\service\MyFct;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class MenuController extends AbstractController
{



    #[Route('/menu/delete', name: 'app_menu_delete')]
    public function delete(EntityManagerInterface $em,Request $request){
        $id=$request->get('id');
        $menu=$em->getRepository(Menu::class)->find($id);
        $libelle=$menu->getLibelle();
        $enfants=$menu->getMenus();
        $nbreEnfant=count($enfants);
        if($nbreEnfant){
            $message="Impossible de supprimer le menu $libelle car il appartient a un sous-menu ";
            $ok=0;
            
        }else{
            $em->remove($menu); //delete the object menu
            $em->flush(); // delete in the table  menu (DB)
            $message="Le menu $libelle a bien ete supprimer dans la Base de donées";
            $ok=1;
        } 
        $responses=[
            'ok'=>$ok,
            'message'=>$message,
        ];
        $responses_json=json_encode($responses);
        echo $responses_json;
        exit();


    }




    #[Route('/menu/show/{id}',name:'app_menu_show')]
    public function show($id,EntityManagerInterface $em){
            $menu=$em->getRepository(Menu::class)->find($id);
        return $this->render("menu/show.html.twig",[
            'menu' => $menu,
        ]);
        
    }







    #[Route('/menu/edit/{id}',name:'app_menu_edit')]
    public function edit($id,EntityManagerInterface $em,Request $request){
        $id=(int) $id;
        if($id==0){
            $menu=new Menu();
        }else{
            $menu=$em->getRepository(Menu::class)->find($id);
        }
        $form=$this->createForm(MenuType::class,$menu);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($menu);
            $em->flush();
            return $this->redirectToRoute('app_menu');
        }
        return $this->render("menu/form.html.twig",[
            'form' => $form,
        ]);
        
    }

    #[Route('/menu', name: 'app_menu')]
    public function index(EntityManagerInterface $em): Response
    {
        $myfct = new MyFct();
        $menus = $em->getRepository(Menu::class)->findBy([], ['parent' => 'asc']);
        $menu=$this->list_menu(null,0,$menus);
        // $menu="<table>$menu</table>";
        
        return $this->render('menu/index.html.twig', [
            'menu' => $menu,
            'nbre'=>count($menus),
        ]);
    }
    public function list_menu($parent, $niveau, $menus)
    {
        $html = "";
        foreach ($menus as $menu) {
            $id = $menu->getId();
            $rang = $menu->getRang();
            $libelle = $menu->getLibelle();
            $url = $menu->getUrl();
            $role = $menu->getRole();
            $icon = $menu->getIcon();
            $parentMenu = $menu->getParent();
            $icon="<ion-icons name='$icon'></icon>";
            if ($parent == $parentMenu) {
                $point = "";
                for ($i = 1; $i <= $niveau; $i++) {
                    $point .= ".............";
                }
                $class=($niveau==0)?"fw-blod fs-5":"";
                $html .= "<tr>";
                $html.="<td class='center'><input type='checkbox'id='$id' name='check' value='$id' onClick='onlyOne(this)'></td>";
                $html .= "<td class='$class'>$point $libelle</td><td>$url</td><td>$icon</td><td>$role</td>";
                $html .= "</tr>";
                $html .= $this->list_menu($menu, $niveau + 1, $menus);
            }
        }
        return $html;
    }
}
