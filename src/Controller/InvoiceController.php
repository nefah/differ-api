<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Entity\Invoice;
use App\Form\InvoiceType;

/**
 * Invoice controller.
 *
 * @Route("/api", name="api_")
 */
class InvoiceController extends FOSRestController
{
    /**
     * Create Invoice.
     *
     * @Rest\Post("/countwords")
     *
     * @return Response
     */
    public function postInvoiceAction(Request $request)
    {
        $invoice = new Invoice();
        $form = $this->createForm(InvoiceType::class, $invoice);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);
        if ($form->isSubmitted() && $form->isValid()) {
            //process the invoice and returns the calculation
            $dataToProcess = $form->getData();
            $words = str_word_count($dataToProcess->getSource(), 1);
            $price = count(array_unique($words)) * $dataToProcess->getPricePerWord();

            return $this->handleView(
                $this->view([
                    'words' => array_count_values($words),
                    'price' => $price,
                ],
                Response::HTTP_CREATED
            ));
        }

        return $this->handleView($this->view($form->getErrors()));
    }
}
