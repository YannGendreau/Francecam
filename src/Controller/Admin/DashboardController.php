<?php

namespace App\Controller\Admin;

use App\Entity\Film;
use App\Entity\User;
use App\Entity\Mount;
use App\Entity\Marque;
use App\Entity\Modele;
use App\Entity\Cameras;
use App\Entity\Director;
use App\Entity\Dirphoto;
use App\Entity\Format;
use App\Entity\Shutter;
use App\Entity\Type;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(FilmCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Francecam');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Cameras', 'fas fa-camera', Modele::class);
        yield MenuItem::linkToCrud('Films', 'fas fa-film', Film::class);
        yield MenuItem::linkToCrud('Marques', 'fas fa-video', Marque::class);
        yield MenuItem::linkToCrud('User', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Mount', 'fas fa-circle', Mount::class);
        yield MenuItem::linkToCrud('Shutter', 'fas fa-circle', Shutter::class);
        yield MenuItem::linkToCrud('Format', 'fas fa-circle', Format::class);
        yield MenuItem::linkToCrud('Réalisation', 'fas fa-circle', Director::class);
        yield MenuItem::linkToCrud('Photo', 'fas fa-circle', Dirphoto::class);
        yield MenuItem::linkToCrud('Type', 'fas fa-circle', Type::class);
    }
}
