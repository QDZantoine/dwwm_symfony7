<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Doctrine\ORM\EntityManagerInterface;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
#[Route('/client')]
class ClientController extends AbstractController
{


    #[Route('/', name: 'app_client')]
    public function index(ClientRepository $cr): Response
    {   $clients=$cr->findAll();
        return $this->render('client/index.html.twig', [
            'clients' => $clients,
            'nbre'=> count($clients),
        ]);
    }
    #[Route('/show/{id}', name: 'app_client_show')]
    public function show(ClientRepository $cr,$id) {
        $client=$cr->find($id);
        return $this->render('client/show.html.twig',[
            'client' => $client,
        ]);

    }
    #[Route('/export/excel',name:'app_client_export_excel')]
    public function exportExcel(EntityManagerInterface $em):Response{
        $file="../public/modele_document/modele-fichier-client.xlsx";
        $spreadsheet=IOFactory::load($file);
        $sheet=$spreadsheet->getActiveSheet();
        $clients=$em->getRepository(Client::class)->findAll();
        $row=4;
        foreach($clients as $client){
            $sheet->insertNewRowBefore($row);
            $sheet->setCellValue("A$row",$client->getNumClient());
            $sheet->setCellValue("B$row",$client->getNomClient());
            $sheet->setCellValue("C$row",$client->getAdresseClient());
            $row++; //$row+=1

        }
        
        $nbre=count($clients);
        $sheet->setCellValue("A$row","Nombres de clients :$nbre ");
        //-------------------Save the data into the file liste_clients.xlsx------
        $target="../public/partage_document/liste_clients.xlsx";
        $writer=new Xlsx($spreadsheet);
        $writer->save($target);
        echo "Export Finished !";exit;
        // return $this->render('client/index.html.twig');

    }




    #[Route('/delete/{id}', name: 'app_client_delete')]
    public function delete(EntityManagerInterface $em,$id){
        $client=$em->getRepository(Client::class)->find($id);
        $em->remove($client);
        $em->flush();
        return $this->redirectToRoute("app_client");


    }

    #[Route('/edit/{id}', name: 'app_client_edit',methods:['POST','GET'])]
    public function edit(EntityManagerInterface $em,ClientRepository $cr,$id,Request $request){
        $id=(int) $id;
        if($id){
            $client=$cr->find($id);
        }else{
            $client=new Client();
        }
        //-----------creation of the form until the clientType on the enity Client = $client
        $form=$this->createForm(ClientType::class,$client);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $em->persist($client);
            $em->flush();
            return $this->redirectToRoute("app_client");
        }
        return $this->render('client/form.html.twig',[
            'form'=>$form->createView(),
        ]);
    }
}
