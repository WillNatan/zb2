<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Shop;
use App\Entity\Address;
use App\Entity\Product;
use App\Entity\Promotion;
use App\Entity\OpeningTime;
use App\Entity\ShopReviews;
use App\Entity\ShopCategory;
use App\Entity\ProductReview;
use App\Entity\ProductCategory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{

    public function slugify($string, $delimiter = '-')
    {
        $oldLocale = setlocale(LC_ALL, '0');
        setlocale(LC_ALL, 'en_US.UTF-8');
        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
        $clean = strtolower($clean);
        $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
        $clean = trim($clean, $delimiter);
        setlocale(LC_ALL, $oldLocale);
        return $clean;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'vendredi', 'Samedi', 'Dimanche'];

        //Ajout catégorie de boutique
        for ($cat = 0; $cat < 15; $cat++) {
            $shopCategory = new ShopCategory();
            $shopCategory->setName($faker->name);
            $manager->persist($shopCategory);

            //Stop ajout catégorie boutique


            //Ajouter entre 1 et 10 boutiques
            for ($b = 0; $b < mt_rand(1, 10); $b++) {
                $shopName = $faker->firstNameMale();
                $shop = new Shop();

                $shop->setShopName($shopName)
                    ->setDescription($faker->paragraph($nbSentences = 3, $variableNbSentences = true))
                    ->setSlug($this->slugify($shopName))
                    ->setShopCategory($shopCategory);

                $manager->persist($shop);
                //stop ajout boutiques

                // Ajouter entre 1 et 5 promotions fidelisation
                for ($pr2 = 0; $pr2 < mt_rand(1, 5); $pr2++) {
                    $promo = new Promotion();
                    $promo->setType('fidelisation')
                        ->setDetails($faker->paragraph($nbSentences = 1, $variableNbSentences = true))
                        ->setLaunchDate(new \DateTime('now'))
                        ->setFinishDate(new \DateTime('now +'.mt_rand(2, 11).' day'))
                        ->setShop($shop);

                    $manager->persist($promo);
                }
                //Stop ajout de promo fidelisation

                // Ajouter entre 1 et 4 adresses
                for($ad=0;$ad<mt_rand(1,4);$ad++)
                {
                    $address = new Address();

                    $address->setStreet($faker->streetAddress)
                    ->setPostalCode($faker->postcode)
                    ->setCity($faker->city)
                    ->setShop($shop);
                    
                    $manager->persist($address);
                }
                // Ajouter horaires d'ouvertures
                for($h=0;$h<mt_rand(1,count($days));$h++)
                {
                    $hour = new OpeningTime();
                    $hour->setShop($shop)
                    ->setDay($days[$h])
                    ->setOpenTime(new \DateTime($faker->time($format = 'H:i', $max = 'now')))
                    ->setCloseTime(new \DateTime($faker->time($format = 'H:i', $max = 'now')));
                    ;

                    
                    $manager->persist($hour);
                }
                //ajouter entre 1 et 30 avis sur la boutique
                $shopReview = new ShopReviews();
                $shopReview->setShop($shop)
                           ->setReviewBody($faker->paragraph($nbSentences = 1, $variableNbSentences = true))
                           ->setName($faker->name)
                           ->setEmail($faker->email)
                           ->setStars(mt_rand(1,5));

                $manager->persist($shopReview);

                //stop avis boutique

                //Ajouter des catégories de produit
                for ($pcat = 0; $pcat < 10; $pcat++) {
                    $productCategory = new ProductCategory();

                    $productCategory->setName($faker->name);
                    $manager->persist($productCategory);
                //stop catégories de produit


                    // Ajouter entre 10 et 50 produits
                    for ($pr = 0; $pr < mt_rand(10, 50); $pr++) {
                        $product = new Product();

                        $product->setName($faker->name)
                            ->setPrice(mt_rand(1, 20))
                            ->setImage($faker->imageUrl($width = 640, $height = 480))
                            ->setProductCategory($productCategory);

                        $manager->persist($product);
                    //stop ajout produits


                        // Ajouter entre 1 et 5 promotions remises
                        for ($pr1 = 0; $pr1 < 1; $pr1++) {
                            $promo = new Promotion();

                            $promo->setProduct($product)
                                ->setType('remise')
                                ->setPercentage(mt_rand(10, 50))
                                ->setLaunchDate(new \DateTime('now'))
                                ->setFinishDate(new \DateTime('now +'.mt_rand(2, 11).' day'))
                                ->setShop($shop);

                            $manager->persist($promo);
                        }
                        //stop ajout promos remise

                        // Ajouter entre 5 et 30 avis sur le produit
                        for ($pr = 0; $pr < mt_rand(5, 30); $pr++) {
                            $productReview = new ProductReview();
                            $productReview->setName($faker->name)
                                ->setProduct($product)
                                ->setReviewBody($faker->paragraph($nbSentences = 3, $variableNbSentences = true))
                                ->setStars(mt_rand(1, 5))
                                ->setEmail($faker->email);

                            $manager->persist($productReview);
                        }
                        //stop ajout avis produit
                    }
                }
            }
        }

        $manager->flush();
    }
}
