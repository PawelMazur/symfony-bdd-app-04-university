<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Cathedral;
use AppBundle\Form\CathedralType;

/**
 * Cathedral controller.
 *
 * @Route("/admin/cathedral")
 */
class CathedralController extends Controller
{

    /**
     * Lists all Cathedral entities.
     *
     * @Route("/", name="admin_cathedral")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Cathedral')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Cathedral entity.
     *
     * @Route("/", name="admin_cathedral_create")
     * @Method("POST")
     * @Template("AppBundle:Cathedral:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Cathedral();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_cathedral_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Cathedral entity.
     *
     * @param Cathedral $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Cathedral $entity)
    {
        $form = $this->createForm(new CathedralType(), $entity, array(
            'action' => $this->generateUrl('admin_cathedral_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Cathedral entity.
     *
     * @Route("/new", name="admin_cathedral_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Cathedral();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Cathedral entity.
     *
     * @Route("/{id}", name="admin_cathedral_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Cathedral')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cathedral entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Cathedral entity.
     *
     * @Route("/{id}/edit", name="admin_cathedral_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Cathedral')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cathedral entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Cathedral entity.
    *
    * @param Cathedral $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Cathedral $entity)
    {
        $form = $this->createForm(new CathedralType(), $entity, array(
            'action' => $this->generateUrl('admin_cathedral_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Cathedral entity.
     *
     * @Route("/{id}", name="admin_cathedral_update")
     * @Method("PUT")
     * @Template("AppBundle:Cathedral:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Cathedral')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cathedral entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_cathedral_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Cathedral entity.
     *
     * @Route("/{id}", name="admin_cathedral_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Cathedral')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Cathedral entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_cathedral'));
    }

    /**
     * Creates a form to delete a Cathedral entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_cathedral_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
