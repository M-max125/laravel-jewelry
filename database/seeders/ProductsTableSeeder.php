<?php

namespace Database\Seeders;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Rings
        for($i=1;$i<=30;$i++){
            Product::create([
                'name' => 'Glitter'.$i,
                'description' =>'Often beauty isn\'t complicated, sometimes it is as simple as your love for one another, a touch of a hand or the catching of an eye. It is what it is - a pure article. Glitter'.$i.' design has been brought to life by our master craftsmen in 18 carat white and yellow gold and keeps the focus on the simplicity and beauty of its components. The Ruby or Paraiba Tourmaline show their spectacular hue and striking shine at the heart of this ring, and it is sure to take centre stage in your collection as well.',
                'price' => rand(199,3999),
                'stars' => rand(1,5),
                'image' => 'ring-'.$i,
                'category_id' => 1
                

            ]);
        }

        //Necklaces
        for($i=1;$i<=24;$i++){
            Product::create([
                'name' => 'Queen'.$i,
                'description' =>'Echoing a queen\'s beauty and presence this gorgeous necklace is a striking design full of life and passion. Featuring over 6 carats of black diamond the necklace has been made and enamelled by hand so you can remain certain of its exquisite quality. Created into beautiful 18ct white gold Queen'.$i.' is set with a total carat weight of 2 carats of white diamonds which complement the black wonderfully and leave you safe in the knowledge that the necklace will always have incredible sparkle.',
                'price' => rand(199,3999),
                'stars' => rand(1,5),
                'image' => 'jw-'.$i,
                'category_id' => 2
                
            ]);
        }

        //Earrings
        for($i=1;$i<=31;$i++){
            Product::create([
                'name' => 'Fiore'.$i,
                'description' =>'Our designers have taken Fiore'.$i.' inspiration from the deep romance of poetry. The poetry in question here is represented by the effortless flow of the precious metal and its relationship with the wonderfully colourful zirconia at its heart so you will be pleased to know your jewellery has beautiful sentiment. Sunrise has been entirely polished and set by hand by our British jewellers so you can rest assured of its unrivalled craftsmanship. In addition to this the range includes a matching ring, pendant and bangle so you can acquire the entire suite of this stunning GlamourLane limited edition design.',
                'price' => rand(199,3999),
                'stars' => rand(1,5),
                'image' => 'ear-'.$i,
                'category_id' => 3
                
            ]);
        }

        //Bracelets
        for($i=1;$i<=36;$i++){
            Product::create([
                'name' => 'Privee'.$i,
                'description' => 'Crafted of colorful gemstones, this bracelet is dazzling. Privee'.$i.' combines beads with natural carnelian, garnet, citrine and tiger\'s eye to create the beautiful design. It fastens with a gold plated clasp.',
                'price' => rand(199,3999),
                'stars' => rand(1,5),
                'image' => 'br-'.$i,
                'category_id' => 4
                
            ]);
        }

        //Brooches
        for($i=1;$i<=12;$i++){
            Product::create([
                'name' => 'Adagio'.$i,
                'description' => 'Celebrate your love and passion for one another with this stunning and stylish Adagio'.$i.' design. This contemporary design features beautiful heart cut outs in the ring shank and is available in either timeless Amethyst or vibrant Peridot so you can choose the perfect piece to suit your skin tone and style.',
                'price' => rand(199,3999),
                'stars' => rand(1,5),
                'image' => 'brooch-'.$i,
                'category_id' => 5
                


            ]);
        }

        //Pendants
        for($i=1;$i<=20;$i++){
            Product::create([
                'name' =>'Jasmine'.$i,
                'description' => 'Inspired by vintage design, this classic necklace features five strings of flawless gems joined by a 9 carat yellow gold flower clasp. A delightfully feminine piece that is sheer perfection. In vibrant colour tones Jasmine'.$i.' is sure to stand out.',
                'price' => rand(199,3999),
                'stars' => rand(1,5),
                'image' => 'pendant-'.$i,
                'category_id' => 6
                

            ]);
        }

    
    }
}
