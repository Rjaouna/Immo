<?php

namespace App\Controller\Admin;

use App\Entity\BienImmo;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Operations;
use EasyCorp\Bundle\EasyAdminBundle\Config\KeyValueStore;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;

class BienImmoCrudController extends AbstractCrudController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public static function getEntityFqcn(): string
    {
        return BienImmo::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setDefaultSort(['id' => 'DESC']);
    }

    public function configureFields(string $pageName): iterable
    {
        $fields = [
            IdField::new('id')->hideOnForm(),
            ImageField::new('Photo', 'Photo')
            ->setBasePath('/images/bienimmo')
            ->setUploadDir('public/images/bienimmo')
            ->setUploadedFileNamePattern('[uuid].[extension]')
            ->setRequired(false),
            TextField::new('Youtube', 'Youtube'),
            TextField::new('Titre', 'Titre'),
            ChoiceField::new('Type', 'Type')
                ->setChoices([
                    'Appartement' => 'appartement',
                    'Maison' => 'maison',
                    'Terrain' => 'terrain',
                ]),
            MoneyField::new('Prix', 'Prix')->setCurrency('EUR')->setStoredAsCents(false),
            ChoiceField::new('Ville', 'Ville')
                ->setChoices([
                    'Casablanca' => 'Casablanca',
                    'Mohammedia' => 'Mohammedia',
                    'Marrakech' => 'Marrakech',
                ]),
            NumberField::new('Superficie', 'Superficie (m²)'),
            NumberField::new('Pieces', 'Nombre de pièces'),
            DateTimeField::new('Annee', 'Année de construction')->setFormat('Y'),
            TextEditorField::new('Description', 'Description'),
           
        ];

        return $fields;
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $this->uploadPhoto($entityInstance);

        parent::updateEntity($entityManager, $entityInstance);
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $this->uploadPhoto($entityInstance);

        parent::persistEntity($entityManager, $entityInstance);
    }

    private function uploadPhoto($entityInstance)
    {
        // Retrieve uploaded file from entity
        $uploadedFile = $entityInstance->getPhoto();

        // Check if there's an uploaded file
        if ($uploadedFile instanceof UploadedFile) {
            // Generate a unique name for the file before saving it
            $newFilename = uniqid().'.'.$uploadedFile->guessExtension();

            // Move the file to the directory where photos are stored
            try {
                $uploadedFile->move(
                    $this->getParameter('kernel.project_dir').'/public/images/bienimmo',
                    $newFilename
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
                // For example, log the error message
                $this->addFlash('error', 'Error uploading file: '.$e->getMessage());
            }

            // Update the 'photo' property to store the file name instead of the file
            $entityInstance->setPhoto($newFilename);
        } elseif ($uploadedFile instanceof File) {
            // If updating existing entity, Symfony sends a File object instead of an UploadedFile
            // In this case, keep the existing file name
            $entityInstance->setPhoto($uploadedFile->getFilename());
        }
    }
}
