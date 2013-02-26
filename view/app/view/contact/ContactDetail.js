/**
 * Contact Detail
 * @version 1.0
 * @alias contactdetail
 */
Ext.define('ExtjsMVC.view.contact.ContactDetail', {
    extend: 'Ext.window.Window',
    alias : 'widget.contactdetail',
    id : 'contactDetailWindow',
    height: 215,
    width: 400,
    modal: true,
    resizable : false,
    layout: 'fit',
    contactRecord: null,
    title: null,

    
    fbar: [
        {
            type: 'button', 
            text: locale.generic.cancel,
            action:'cancel',
            icon : 'resources/img/icons/cross.png'
        },
        {
            type: 'button', 
            text: locale.generic.save,
            action:'save',
            icon : 'resources/img/icons/save.png'
        }
    ],
    
    
    initComponent: function(){
         
        var form = Ext.create('Ext.form.Panel', {   
            id: 'contactForm',
            border: false,
            width: 350,
            scroll:false,
                
            defaults: {
                xtype: 'textfield',
                msgTarget: 'under',
                labelAlign: 'left',
                anchor: '100%'    
            },

            
            items: [                
                {
                    name: 'name',
                    allowBlank: false,
                    fieldLabel: locale.contactDetail.name,
                    blankText: locale.contactDetail.nameBlankErrorMessage,
                    maxLength: 100
                },
                {
                    name: 'lastname',
                    allowBlank: false,
                    fieldLabel: locale.contactDetail.lastname,
                    blankText: locale.contactDetail.lastnameBlankErrorMessage,
                    maxLength: 100
                },
                {
                    name: 'phone',
                    fieldLabel: locale.contactDetail.phone,
                    maxLength: 100
                },
                {
                    name      : 'email',
                    fieldLabel: locale.contactDetail.email,
                    maxLength: 100
                },
            ]
        });
        
        /* Loads Record in the form*/
        if(this.contactRecord){
            form.loadRecord(this.contactRecord);
        }
        
        
        
        var formPanel = Ext.create('Ext.panel.Panel', {
            layout: 'border',
            border:false,
            bodyStyle: {
                background: 'white',
                padding: '10px'
            },
            items: [ form ]
        });
        
        
         
        this.items = [formPanel];
        this.callParent(arguments);
    },
    
    listeners: {
        move: function(cmp, x, y){
            if(y < 0){
                y = 15
                cmp.setPosition(x, y);
            }
            if(x < 0){
                cmp.setPosition(15, y);
            }
        }
    }
    
});