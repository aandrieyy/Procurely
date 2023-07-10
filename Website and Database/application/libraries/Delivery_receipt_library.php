<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Delivery_receipt_library
{

    public $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->model('delivery_receipt_model');
        $this->CI->load->model('invoices_model');
        $this->CI->load->model('suppliers_model');
        $this->CI->load->model('customers_model');
        $this->CI->load->model('businesses_model');
    }

    public function get_sold_to($id_customer_type,$id_customer){
        if($id_customer_type == 3){ //CUSTOMERS
           return $sold_to = $this->CI->customers_model->get($id_customer)->row();
        }
        if($id_customer_type == 5){ //BUSINESS
            return $sold_to = $this->CI->businesses_model->get($id_customer)->row();
         }
    }

    public function pdf_po($id_dr){
        $dr = $this->CI->delivery_receipt_model->get('',$id_dr)->row();
        $delivery_receipt_details = $this->CI->delivery_receipt_model->get_dr_details($id_dr)->result();

        if($dr->id_customer != '0'){
            if($dr->id_customer_type == 3){ //CUSTOMERS
                $sold_to = $this->CI->customers_model->get($dr->id_customer)->row();
                $name = $sold_to->name;
                $address = $sold_to->address;
                $tin = 'N/A';
            }else{ //BUSINESS
                $sold_to = $this->CI->businesses_model->get($dr->id_customer)->row();
                $name = $sold_to->business_name;
                $address = $sold_to->bs_address;
                $tin = $sold_to->bs_tin;
            }
        }else{
                $name = '';
                $address = '';
                $tin = '';
        }

        $dr_details = '';

        $count = 0;
        foreach($delivery_receipt_details as $row){
            $count += 1;
            $dr_details .= '
                <tr>
                    <td  border="1">'.$count.'</td>
                    <td  border="1">'.$row->qty.'</td>
                    <td  border="1">'.$row->product_name.'('.$row->brand.')</td>
                    <td  border="1">'.$row->serial_number.'</td>
                </tr>
            '; 
        }


        $text = ' 
        <table style="width:100%;">
            <tr>
                <td width="60%" rowspan="6"><img src="public/assets/img/logo.png" style="width:300px"></td>
                <td width="40%" style="vertical-align: middle;"><h1><b>DELIVERY RECEIPT</b></h1></td>
            </tr>
            <tr>
                <td style="font-size:10px">3rd flr. Wichita Land Bldg. 61</td>
            </tr>
            <tr>
                <td style="font-size:10px">Visayas Avenue Project 6, Brgy. Vasra,</td>
            </tr>
            <tr>
                <td style="font-size:10px">Quezon City 1128</td>
            </tr>
            <tr>
                <td style="font-size:10px">Tel. 275-5225/ 09426539472/ 09951218617</td>
            </tr>
            <tr>
                <td style="font-size:10px">VAT REG. TIN 008-995-410-000</td>
            </tr>
        </table>

        <br><br>

        <table>
            <tr>
                <td style="font-size:10px;">
                    <b>DELIVER TO:</b> '.$name.'<br>	
                    <b>ADDRESS:</b> '.$address.'<br>			
                    <b>TIN:</b> '.$tin.'<br>		
                    <b>SHIP TO:</b> '.$dr->ship_to.'<br>		
                </td> 

                <td style="font-size:9px;">
                </td> 

                <td style="font-size:10px;">	
                    <b>D.R No.:</b> <span style="color:red">'.$dr->dr_nos.'</span> <br>	
                    <b>DATE:</b>  '.$dr->date.'<br>		
                    <b>P.O. NO.:</b> '.$dr->po_nos.'<br>		
                    <b>TERMS:</b> '.$dr->terms.'<br>            
                    <b>SALES PERSON:</b> '.$dr->sales_person.'<br>            
                </td> 
            </tr>
        </table>

        <br><br>

        <table cellpadding="2">
            <tr>
                <td width="10%" style="background-color:#999999">NO.</td>
                <td width="10%" style="background-color:#999999">QTY</td>
                <td width="60%" style="background-color:#999999">ITEM/DESCRIPTION</td>
                <td width="20%" style="background-color:#999999">SERIAL NUMBER</td>
            </tr>
            '.$dr_details.'
            <tr>
                <td  border="1"></td>
                <td  border="1"></td>
                <td  border="1"></td>
                <td  border="1"></td>
            </tr>
            <tr>
                <td  border="1"></td>
                <td  border="1"></td>
                <td  border="1"></td>
                <td  border="1"></td>
            </tr>
            <tr>
                <td  border="1"></td>
                <td  border="1"></td>
                <td  border="1"></td>
                <td  border="1"></td>
            </tr>
            <tr>
                <td  border="1"></td>
                <td  border="1"></td>
                <td  border="1"></td>
                <td  border="1"></td>
            </tr>
            <tr>
                <td  border="1"></td>
                <td  border="1"></td>
                <td  border="1"></td>
                <td  border="1"></td>
            </tr>
            <tr>
                <td  border="1"></td>
                <td  border="1"></td>
                <td  border="1"></td>
                <td  border="1"></td>
            </tr>
        </table>

        <br><br>

        <table align="center">
            <tr>
                <td><b>'.$dr->prepared_by.'</b></td>
                <td></td>
                <td><b> </b></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid #000;">Prepared By</td>
                <td></td>
                <td style="border-top: 1px solid #000;></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid #000;"></td>
                <td></td>
                <td style="border-top: 1px solid #000;>Signature Over Printed Name</td>
            </tr>
        </table>

        <br>  <br> 

        <table align="center">
            <tr>
                <td></td>
                <td></td>
                <td><b> </b></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td style="border-top: 1px solid #000;></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid #000;"></td>
                <td></td>
                <td style="border-top: 1px solid #000;>Date</td>
            </tr>
        </table>
        
        ';
        return $text;
    }


}
