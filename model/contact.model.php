<?php
class Contact extends Model {
    var $name = 'contact';
    var $table = 'contact';
    var $idField = 'id';
    var $fields = array(   
                            'id', 
                            'name',
                            'lastname',
                            'phone',
                            'email'
                       );
}
?>