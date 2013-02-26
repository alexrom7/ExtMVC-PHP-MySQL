/** 
 * Contact List Controller
 */
Ext.define('ExtjsMVC.controller.ContactListController', {
    extend: 'Ext.app.Controller',
  
    stores: [ 'Contacts' ],
    views:  ['contact.ContactList','contact.ContactDetail'],  
    models: ['Contact'],
    
    
    init: function() {
     
        this.control({
            'contactlist':{
                itemmouseenter: this.showEditIcon,
                itemmouseleave: this.hideEditIcon,
                cellclick: this.editContact
            },
            'contactlist > toolbar > button[action=add]':{
                click: this.addContact
            },
             'contactlist > toolbar > button[action=delete]':{
                click: this.deleteContacts
            },
            'contactdetail > toolbar > button[action=save]':{
                click: this.saveContact  
            },
            'contactdetail > toolbar > button[action=cancel]':{
                click: this.closeWindow
            },
            'contactdetail > panel > form > textfield':{
                specialkey: function(field, e){
                    if (e.getKey() == e.ENTER)
                        this.saveContact();
                }
            }
        });
        
    },
    
    /**
     * Handles a mouseenter event on a task grid item.
     * Shows the item's action icons.
     * @param {Ext.grid.View} view
     * @param {SimpleTasks.model.Task} task
     * @param {HTMLElement} node
     * @param {Number} rowIndex
     * @param {Ext.EventObject} e
     */
    showEditIcon: function(view, task, node, rowIndex, e) {
        var icons = Ext.DomQuery.select('.x-action-col-icon', node);
        Ext.each(icons, function(icon){
            Ext.get(icon).removeCls('x-hidden');
        });
    },
    
    /**
     * Handles a mouseleave event on a task grid item.
     * Hides the item's action icons.
     * @param {Ext.grid.View} view
     * @param {SimpleTasks.model.Task} task
     * @param {HTMLElement} node
     * @param {Number} rowIndex
     * @param {Ext.EventObject} e
     */
    hideEditIcon: function(view, task, node, rowIndex, e) {
        var icons = Ext.DomQuery.select('.x-action-col-icon', node);
        Ext.each(icons, function(icon){
            Ext.get(icon).addCls('x-hidden');
        });
    },
    
    
    editContact: function( grid, td, cellIndex,record, tr, rowIndex){
        
        if (cellIndex != 0){
            Ext.create('ExtjsMVC.view.contact.ContactDetail', {
                contactRecord: record,
                title: locale.contactDetail.editionTitle,
                icon : 'resources/img/icons/pencil.png'
            }
            ).show();
        }
    },
    
    addContact: function(button){
        var contactRecord = Ext.create('ExtjsMVC.model.Contact');
            
        Ext.create('ExtjsMVC.view.contact.ContactDetail', {
            title: locale.contactDetail.creationTitle,
            contactRecord: contactRecord,
            icon : 'resources/img/icons/add.png'
        }
        ).show();
    },
    
    
    saveContact: function(){
        var form = Ext.getCmp('contactForm').getForm(); 
        if (form.isValid()) {
            var formValues = form.getValues();
            var successMessage = '';
            var contactRecord = form.getRecord();
        
            contactRecord.set({
                name: formValues['name'], 
                lastname: formValues['lastname'], 
                phone: formValues['phone'], 
                email:formValues['email']
            });
        
            // Create New Contact
            if (contactRecord.get('id') == '')
                successMessage = locale.contactDetail.creationSuccess
       
            // Modify Contact
            else
                successMessage = locale.contactDetail.editionSuccess
        
        
            contactRecord.save({
                success: function(opt, r){
                    var msg=Ext.create('components.MessageBox');
                    if(r.response.result.success == true){
                        msg.show('success',successMessage);
                        
                        var grid = Ext.getCmp('contactListGrid');               
                        grid.getStore().load();
                        Ext.getCmp('contactDetailWindow').close();
                    }
                                
                    else{
                        msg.show('error',locale.messageDisplay.dataError);
                    }       
                }
            });
        }

    },
    
    /* Remove the selected Contacts */
    deleteContacts: function(button){
         var grid = button.up('grid');
        var selModel = grid.getSelectionModel().getSelection();
        
        var superData = [];
        
        for (rec in selModel) {
            superData.push(selModel[rec].getData());
        }

        if (superData.length > 0) {

            Contacts.removeContacts(superData,{
                success: function(opt, r){   
                    var grid = Ext.getCmp('contactListGrid');
                    var msg=Ext.create('components.MessageBox');
                    
                    if(r.result.success == true){
                        msg.show('success',locale.contactDetail.deletionSuccess);   
                        grid.getStore().loadPage(1);
                    }
                                
                    else{
                        msg.show('success',locale.contactDetail.deletionError);
                        grid.getStore().loadPage(1);
                    }    
                }
            });
        }
    },
    
    closeWindow: function(button){
        button.up('window').close();
    }

});