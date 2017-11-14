<?php

use Illuminate\Database\Seeder;

class AlumniTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo getcwd();
        $row = 1;
        if (($handle = fopen("ordained.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

                $name = $data[0];
                $diocese = $data[1];
//            $birthday = $data[2];
//            $ordination = $data[3];
                $address = $data[4];
                $phone = $data[5];
                $fax = $data[6];
                $mobile = $data[7];
                $email = $data[8];

                //echo "$name - $diocese - $birthday - $ordination - $address - $phone - $fax - $mobile - $email <hr>";

                $current = new \App\Alumni();

                $current->first_name = preg_replace('/[^A-Za-z0-9\-\ \.\,]/', '', $name);
                $current->last_name = '';
                $current->nickname= '';
                $current->diocese = preg_replace('/[^A-Za-z0-9\-\ \.\,]/', '', $diocese);
                $current->address = preg_replace('/[^A-Za-z0-9\-\ \.\,]/', '', $address);
                $current->telephone_num = $phone;
                $current->fax_num = $fax;
                $current->alumni_type = 'ordained';
                $current->mobile_num = $mobile;
                $current->email = $email;
                $current->save();
                print_r ($current->toArray());
                $row++;

            }
            fclose($handle);
        }

        $row = 1;
        if (($handle = fopen("lay.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

                $name = $data[0];
//            $birthday = $data[1];
                $years_in_sj = $data[2];
                $address = $data[3];
                $phone = $data[4];
                $fax = $data[5];
                $mobile = $data[6];
                $email = $data[7];

                //echo "$name - $diocese - $birthday - $ordination - $address - $phone - $fax - $mobile - $email <hr>";

                $current = new \App\Alumni();

                $current->first_name = preg_replace('/[^A-Za-z0-9\-\ \.\,]/', '', $name);
                $current->last_name = '';
                $current->nickname= '';
                $current->address = preg_replace('/[^A-Za-z0-9\-\ \.\,]/', '', $address);
                $current->telephone_num = preg_replace('/[^A-Za-z0-9\-\ \.\,]/', '', $phone);
                $current->fax_num = $fax;
                $current->alumni_type = 'lay';
                $current->mobile_num = $mobile;
                $current->email = $email;
                $current->save();
                print_r ($current->toArray());
                $row++;

            }
            fclose($handle);
        }
    }
}
