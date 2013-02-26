/**
 * Project Application Icon Model
 * @author Alexis Romero
 * @version 1.0
 */

Ext.define('ExtjsMVC.model.Contact', {
    extend: 'Ext.data.Model',
    fields: [   
        'id',
        'name',
        'lastname',
        'phone',
        'email'
    ],
    
              
    proxy: {  
        type: 'direct',
        
        api: {
            create:  Contacts.save,
            update:  Contacts.save 
        }
    }
});