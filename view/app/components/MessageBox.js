/** 
 * Dynamic messages
 * @author Giancarlo Sanchez
 * @version 1.0
 * @alias messageBox
 */
Ext.define('components.MessageBox' ,{
    alias : 'widget.messageBox',
    extend: 'Ext.Panel',
    id : 'messageBox',
    floating: true,
    msgCt: null,

    constructor: function(){
        return this
    },
    createBox: function (t, s){
        var title;
        if (t=='success'){
            title = locale.messageDisplay.success;
            return ['<div class="msg">', '<h3>', title, '</h3>', s, '</div>'].join('');  
        }
        else if (t == 'info'){
            title = locale.messageDisplay.info;
            return ['<div class="msginfo">', '<h3>', title, '</h3>', s, '</div>'].join(''); 
        }
        else if (t=='error'){
            title = locale.messageDisplay.error
            return ['<div class="msgerr">', '<h3>', title, '</h3>', s, '</div>'].join('');  
        }
    },
    show: function(type, msg){
            
            if(!this.msgCt){
                this.msgCt = Ext.DomHelper.insertFirst(document.body, {id:'msg-div'}, true);
                
            }
            
            this.msgCt.alignTo(document, 't-t');
            var m = Ext.DomHelper.append(this.msgCt, {html:this.createBox(type, msg)}, true);
            m.slideIn('t', {
                                easing: 'easeIn',
                                border: false,
                                duration: 0.5
                            });              
            m.pause(2500);
            m.ghost('t',{remove:true});
    }
});