<?php
require_once('../vendor/autoload.php');
class Customer{
    private $db;
    public function __construct(){
        $this->db = new Database;
    }
    //save the payment info
    public function addCustomer($data){

        //prepare query
        $this->db->query('INSERT INTO payment(id,fname,lname,email,phone) VALUES(:id, :first_name, :last_name, :email, :phone)');

        //Bind values
        $this->db->bind(':id',$data['id']);
        $this->db->bind(':first_name',$data['first_name']);
        $this->db->bind(':last_name',$data['last_name']);
        $this->db->bind(':email',$data['email']);
        $this->db->bind(':phone',$data['phone']);
        
        //Excute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
    //display the payment info
    public function getCustomers(){
        $this->db->query('SELECT * FROM payment ORDER BY created_at DESC');

        $result = $this->db->resultset();

        return $result;
    }
    public function updateAppNow($data,$id)
    {
        $book = 1;
        $this->db->query('UPDATE appointments SET booked=:book,pat_id=:pat_id WHERE date=:appDate AND time=:apTime');
        $this->db->bind(':book',$book);
        $this->db->bind(':pat_id',$id);
        $this->db->bind(':appDate',$data['app_date']);
        $this->db->bind(':apTime',$data['time_select']);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
    //once the appointment registered then the time will be marked
    //as booked in the appointment table
    public function updateAppointments($data){
        $this->db->query('select * from doctorapp where contact = :phone');
        $this->db->bind(':phone',$data['phone']);
        $result = $this->db->single();
        $this->updateAppNow($data,$result->id);
        

    }
   
    //save the current appointment
    public function addAppointment($data){
        //prepare query
        
        $this->db->query('INSERT INTO doctorapp(fname,lname,email,contact) VALUES(:first_name, :last_name, :email, :phone)');

        //Bind values
        $this->db->bind(':first_name',$data['first_name']);
        $this->db->bind(':last_name',$data['last_name']);
        $this->db->bind(':email',$data['email']);
        $this->db->bind(':phone',$data['phone']);        
        //Excute
        if($this->db->execute()){
            $this->updateAppointments($data);
            return true;
        }else{
            return false;
        }
    }
    //collect all appointments and display them
    public function getPatients()
    {
        $this->db->query('SELECT * FROM doctorapp');
        $result = $this->db->resultset();
        return $result;
    }
    //search a certain patient
    public function getPatient($var)
    {
        $this->db->query('SELECT * FROM doctorapp WHERE conatct =:contact');
        $this->db->bind(':contact',$var['phone']);
        $result = $this->db->single();
    }
    //when a patient piked a time this function will provide the doctor available 
    //at that time
    public function getDoctor($var)
    {
        $this->db->query("SELECT * FROM appointments WHERE time= :time");
        $this->db->bind(':time',$var);
        $result = $this->db->single();
        return $result;
    }
    //get the doctor with the first time that not booked
    public function getFirstDoctor($time){
        $booked = ($time == "")?'0':$time;
        $this->db->query("SELECT * FROM appointments WHERE booked=:booked");
        $this->db->bind(':booked',$booked);
        $result = $this->db->single();
        return $result;
    }
    //save the patient information in a seperate table as a customer for the hospital
    public function savePatient($var)
    {
        $this->db->query('INSERT INTO patient_info(fname,lname,email,phone,street,city,zip,country,state) VALUES(:first_name, :last_name, :email, :phone, :street, :city, :zip, :country, :state)');
        $this->db->bind(':first_name',$var['first_name']);
        $this->db->bind(':last_name',$var['last_name']);
        $this->db->bind(':email',$var['email']);
        $this->db->bind(':phone',$var['phone']);
        $this->db->bind(':street',$var['street']);
        $this->db->bind(':city',$var['city']);
        $this->db->bind(':zip',$var['zip']);
        $this->db->bind(':country',$var['country']);
        $this->db->bind(':state',$var['state']);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
    //once the date piked the appointment table will be filled with that date
    //and time periods between 6:00am-5:00pm with a doctor for each time period
    public function fillAppointmentWith($time)
    {
        $this->db->query("SELECT * FROM appointments WHERE date=:time AND booked=:booked");
        $this->db->bind(':time',$time);
        $this->db->bind(':booked',0);
        if($result = $this->db->resultset()){
            foreach($result as $rs){
                echo "<option  value='".$rs->time."'>".$rs->time."</option>";
            }
        }else{
            $this->db->query("SELECT * FROM times");
            $result = $this->db->resultset();
            foreach($result as $rs){
                $this->db->query("INSERT INTO appointments(date,time,drname,booked,pat_id) VALUES(:date,:time,:doctor,0,0)");
                $this->db->bind(':date',$time);
                $this->db->bind(':time',$rs->time);
                $this->db->bind(':doctor',$rs->drname);
                echo "<option  value='".$r->time."'>".$rs->time."</option>";
                $this->db->execute();
            }
        }
    }
    //display the patient personal infomation
    public function getPatientsInfo()
    {
        $this->db->query('SELECT * FROM patient_info');
        $result = $this->db->resultset();
        return $result;
    }
    public function removePatient($phone)
    {
        //remove patient info
        $this->db->query('DELETE FROM patient_info WHERE phone= :phone');
        $this->db->bind(':phone',$phone);
        $this->db->execute();
        $this->db->query('SELECT * FROM doctorapp WHERE contact= :phone');
        $this->db->bind(":phone",$phone);
        $result = $this->db->single();
        //remove patient from appointment table
        $this->db->query('UPDATE appointments SET pat_id=0,booked=0 WHERE pat_id= :pat_id');
        $this->db->bind(':pat_id',$result->id);
        $this->db->execute();
        //remove patient from doctorapp table
        $this->db->query('DELETE FROM doctorapp WHERE contact= :phone');
        $this->db->bind(':phone',$phone);
        $this->db->execute();
        //find the customer id from payment 
        $this->db->query('select * FROM payment WHERE phone = :phone');
        $this->db->bind(":phone",$phone);
        $result = $this->db->single();
        //remove patient from payment table
        $this->db->query('DELETE FROM patient_info WHERE phone= :phone');
        $this->db->bind(':phone',$phone);
        $this->db->execute();
        //find the customer id from payment 
        $this->db->query('DELETE FROM payment WHERE phone = :phone');
        $this->db->bind(":phone",$phone);
        $this->db->execute();
        //remove patient from transaction table
        $this->db->query('DELETE FROM transactions WHERE customer_id= :customer_id');
        $this->db->bind(':customer_id',$result->id);
        $this->db->execute();
    }
    public function updatePatient($data)
    {
        $phone = $data['old_phone'];
        $this->db->query('UPDATE patient_info SET fname= :first_name, lname= :last_name, email= :email, phone= :phone, street= :street, city= :city, zip= :zip, country= :country, state= :state WHERE phone= :old_phone');
        $this->db->bind(':first_name',$data['fname']);
        $this->db->bind(':last_name',$data['lname']);
        $this->db->bind(':email',$data['email']);
        $this->db->bind(':phone',$data['phone']);
        $this->db->bind(':street',$data['street']);
        $this->db->bind(':city',$data['city']);
        $this->db->bind(':zip',$data['zip']);
        $this->db->bind(':country',$data['country']);
        $this->db->bind(':state',$data['state']);
        $this->db->bind(':old_phone',$phone);
        $this->db->execute();
        $this->db->query('UPDATE doctorapp SET fname= :first_name,lname= :last_name, email= :email, contact= :phone');
        $this->db->bind(':first_name',$data['fname']);
        $this->db->bind(':last_name',$data['lname']);
        $this->db->bind(':email',$data['email']);
        $this->db->bind(':phone',$data['phone']);
        $this->db->execute();
        $this->db->query('UPDATE payment SET fname= :first_name,lname= :last_name, email= :email, phone= :phone');
        $this->db->bind(':first_name',$data['fname']);
        $this->db->bind(':last_name',$data['lname']);
        $this->db->bind(':email',$data['email']);
        $this->db->bind(':phone',$data['phone']);
        $this->db->execute();
    }
    public function updateAppointment($data)
    {
        $phone = $data['update_app_phone'];
        $this->db->query('SELECT * FROM doctorapp WHERE contact= :phone');
        $this->db->bind(':phone',$phone);
        $result = $this->db->single();
        $this->db->query('UPDATE appointments SET pat_id=0, booked=0 WHERE pat_id= :id');
        $this->db->bind(':id',$result->id);
        $this->db->execute();
        $this->db->query('UPDATE appointments SET pat_id= :pat_id, booked=1 WHERE date= :app_date AND time= :app_time');
        $this->db->bind(':pat_id',$result->id);
        $this->db->bind(':app_date',$data['app_date']);
        $this->db->bind(':app_time',$data['time_select']);
        $this->db->execute();
    }
    public function removeAppointment($phone)
    {
        //remove patient info
        $this->db->query('SELECT * FROM doctorapp WHERE contact= :phone');
        $this->db->bind(":phone",$phone);
        $result = $this->db->single();
        //remove patient from appointment table
        $this->db->query('UPDATE appointments SET pat_id=0,booked=0 WHERE pat_id= :pat_id');
        $this->db->bind(':pat_id',$result->id);
        $this->db->execute();
        //remove patient from doctorapp table
        $this->db->query('DELETE FROM doctorapp WHERE contact= :phone');
        $this->db->bind(':phone',$phone);
        $this->db->execute();
        //find the customer id from payment 
        $this->db->query('select * FROM payment WHERE phone = :phone');
        $this->db->bind(":phone",$phone);
        $result = $this->db->single();
        //remove patient from payment table
        $this->db->query('DELETE FROM patient_info WHERE phone= :phone');
        $this->db->bind(':phone',$phone);
        $this->db->execute();
        //find the customer id from payment 
        $this->db->query('DELETE FROM payment WHERE phone = :phone');
        $this->db->bind(":phone",$phone);
        $this->db->execute();
        //remove patient from transaction table
        $this->db->query('DELETE FROM transactions WHERE customer_id= :customer_id');
        $this->db->bind(':customer_id',$result->id);
        $this->db->execute();
    }
}
?>