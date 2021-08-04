<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Customer;
use App\Form\Type\CustomerType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerController extends AbstractApiController
{
    /**
     * @Route("/api/v1/customers", methods="GET")
     */
    public function indexAction(Request $request): Response
    {
        $customers = $this->getDoctrine()->getRepository(Customer::class)->findAll();

        return $this->respond($customers);
    }

    /**
     * @Route("/api/v1/customers/create", methods="POST")
     */
    public function createAction(Request $request): Response
    {
        $form = $this->buildForm(CustomerType::class);

        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->respond($form, Response::HTTP_BAD_REQUEST);
        }

        /**
         * @var Customer $customer
         */
        $customer = $form->getData();

        $this->getDoctrine()->getManager()->persist($customer);
        $this->getDoctrine()->getManager()->flush();

        return $this->respond($customer);
    }

    /**
     * @Route("/api/v1/customers/edit/{id}", methods="PUT")
     */
    public function editAction($id = null, Request $request): Response
    {
        $customer = $this->getDoctrine()->getRepository(Customer::class)->find($id);

        if (is_null($customer)) {
            return new Response('Customer not found!', Response::HTTP_BAD_REQUEST);
        }

        $customerEntity = new Customer();

        $form = $this->buildForm(CustomerType::class, $customerEntity, [
            'method' => 'PUT',
        ]);

        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->respond('Invalid data.', Response::HTTP_BAD_REQUEST);
        }

        $customer->setEmail($form["email"]->getData());
        $customer->setPhoneNumber($form["phoneNumber"]->getData());

        $this->getDoctrine()->getManager()->flush();

        return new Response('Customer Sucessfully Updated!', Response::HTTP_OK);
    }

    /**
     * @Route("/api/v1/customers/delete/{id}", methods="DELETE")
     */
    public function deleteAction($id = null): Response
    {
        $customer = $this->getDoctrine()->getRepository(Customer::class)->find($id);

        if (is_null($customer)) {
            return new Response('Customer not found!', Response::HTTP_BAD_REQUEST);
        }

        $this->getDoctrine()->getManager()->remove($customer);
        $this->getDoctrine()->getManager()->flush();

        return new Response('Customer Sucessfully Deleted!', Response::HTTP_OK);
    }
}
