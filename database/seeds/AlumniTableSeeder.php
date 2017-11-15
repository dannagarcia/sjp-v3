<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

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

                $last_name = $data[0];
                $first_name = $data[1];
                $middle_initial = $data[2];
                $midname_title = $data[3];
                $diocese = $data[4];
                $birthday = $data[5];
                $ordination = $data[6];
                $address = $data[7];
                $phone = $data[8];
                $fax = $data[9];
                $mobile = $data[10];
                $email = $data[11];
                echo $last_name;
                //echo "$name - $diocese - $birthday - $ordination - $address - $phone - $fax - $mobile - $email <hr>";

                $current = new \App\Alumni();

                $current->first_name = preg_replace('/[^A-Za-z0-9\-\ \.\,]/', '', $first_name);
                $current->last_name = preg_replace('/[^A-Za-z0-9\-\ \.\,]/', '', $last_name);
                $current->middle_initial = $middle_initial . '.';
                $current->nickname= '';

                $current->birthdate= $this->getDate($birthday);
                $current->ordination= $this->getDate($ordination);



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

                $last_name = $data[0];
                $name_prefix = $data[1];
                $first_name = $data[2];
                $middle_initial = $data[3];

                $birthday = $data[4];
                $years_in_sj = $data[5];
                $address = $data[6];
                $phone = $data[7];

                $fax = $data[8];
                $mobile = $data[9];
                $email = $data[10];

                //echo "$name - $diocese - $birthday - $ordination - $address - $phone - $fax - $mobile - $email <hr>";

                $current = new \App\Alumni();

                $current->first_name = preg_replace('/[^A-Za-z0-9\-\ \.\,]/', '', $first_name);
                $current->last_name = preg_replace('/[^A-Za-z0-9\-\ \.\,]/', '', $last_name);
                $current->nickname= '';
                $current->middle_initial = $middle_initial . '.';

                $current->birthdate= $this->getDate($birthday);
                $current->years_in_sj= preg_replace('/[^A-Za-z0-9\-\ \.\,]/', '', $years_in_sj);
                $current->address = preg_replace('/[^A-Za-z0-9\-\ \.\,]/', '', $address);
                $current->telephone_num = preg_replace('/[^A-Za-z0-9\-\ \.\,]/', '', $phone);

                $current->fax_num = $fax;
                $current->mobile_num = $mobile;
                $current->email = $email;

                $current->alumni_type = 'lay';

                $current->save();
                print_r ($current->toArray());
                $row++;

            }
            fclose($handle);
        }
    }

    private function getDate($str){
//        echo $str . '\n';
//        $r = '';
        try{
            $r = Carbon::createFromFormat('F j Y', $str)->toDateTimeString();
        } catch (Exception $e){
            echo $e;
            return null;
        }
        echo $r;
        return $r;
//        return \Carbon\Carbon::parse(date_format($str,'F j  Y'));
    }
}
