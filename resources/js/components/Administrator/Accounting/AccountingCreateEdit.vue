<template>
    <div>
        <div class="section">
            <div class="columns is-centered">
                <div class="column is-8-desktop is-10-tablet">
                    <div class="box">
                        <div class="has-text-weight-bold">ADD/EDIT RECORD</div>

                        <div class="mt-2">


                            <div class="columns">
                                <div class="column">
                                    <b-field label="Date Time"
                                             :type="errors.date_time ? 'is-danger':''"
                                             :message="errors.date_time ? errors.date_time[0] : ''">
                                        <b-datetimepicker v-model="fields.date_time" required></b-datetimepicker>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Transaction No."
                                             :type="errors.transaction_no ? 'is-danger':''"
                                             :message="errors.transaction_no ? errors.transaction_no[0] : ''">
                                        <b-input type="text" placholder="Transaction No."
                                                 v-model="fields.transaction_no" required>
                                        </b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Training Control No."
                                             :type="errors.training_control_no ? 'is-danger':''"
                                             :message="errors.training_control_no ? errors.training_control_no[0] : ''">
                                        <b-input type="text" placholder="Training Control No."
                                                 v-model="fields.training_control_no" required>
                                        </b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Transaction Type" expanded
                                             :type="errors.transaction_type_id ? 'is-danger':''"
                                             :message="errors.transaction_type_id ? errors.transaction_type_id[0] : ''">
                                        <b-select placholder="Transaction Type" expanded
                                                  v-model="fields.transaction_type_id">
                                            <option :value="item.transaction_type_id" v-for="(item, index) in transactionTypes"
                                                    :key="index">{{ item.transaction_type }}</option>
                                        </b-select>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Bank Account/Payee">
                                        <modal-browse-payee
                                            @browsPayee="emitPayee"
                                            :prop-name="payee.bank_account_payee"></modal-browse-payee>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Particulars"
                                             :type="errors.particulars ? 'is-danger':''"
                                             :message="errors.particulars ? errors.particulars[0] : ''">
                                        <b-input type="text" placholder="Particulars"
                                                 v-model="fields.particulars">
                                        </b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Total Amount"
                                             :type="errors.total_amount ? 'is-danger':''"
                                             :message="errors.total_amount ? errors.total_amount[0] : ''">
                                        <b-numberinput placholder="Total Amount"
                                            :controls="false" step="0.0001"
                                            v-model="fields.total_amount">
                                        </b-numberinput>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">

                                    <b-field label="Documentary Attachments">
                                        <div class="m-2">
                                            <div class="my-2" v-for="(item, ixdoc) in fields.documentary_attachments" :key="`doc${ixdoc}`">
                                                <div class="columns">
                                                    <div class="column">
                                                        <b-field label="Attachment" label-position="on-border" expanded>
                                                            <b-select v-model="item.document_attachment" expanded required>
                                                                <option value="" v-for="(i, ix) in documentaryAttachments"
                                                                        :key="`idoc${ix}`" :value="i.documentary_attachment_id">{{ i.documentary_attachment }}</option>
                                                            </b-select>
                                                        </b-field>
                                                    </div>
                                                    <div class="column">
                                                        <b-field class="file is-primary" :class="{'has-name': !!item.image_upload}">
                                                            <b-upload v-model="item.image_upload" class="file-label">
                                                            <span class="file-cta">
                                                                <b-icon class="file-icon" icon="upload"></b-icon>
                                                                <span class="file-label">Click to upload</span>
                                                            </span>
                                                                <span class="file-name" v-if="item.image_upload">
                                                                {{ item.image_upload.name }}
                                                            </span>
                                                            </b-upload>
                                                        </b-field>
                                                    </div>

                                                    <div class="column is-1">
                                                        <b-button icon-left="delete-outline"
                                                            @click="removeDoctAttchment(ixdoc)"
                                                            class="is-danger">
                                                        </b-button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="buttons mt-2">
                                                <b-button @click="newDocAttachment"
                                                    icon-left="plus"
                                                    class="button is-small is-outlined is-primary">
                                                    NEW ATTACHMENT
                                                </b-button>
                                            </div>
                                        </div>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Allotment Class" label-position="on-border" expanded>
                                        <b-select v-model="fields.allotment_class_id"
                                            @input="refreshAccountAllotment" 
                                            expanded>
                                            <option value="" v-for="(i, ix) in allotmentClasses"
                                                :key="`allotclass${ix}`"
                                                :value="i.allotment_class_id">{{ i.allotment_class }}</option>
                                        </b-select>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Account">
                                        <modal-browse-allotment-class-account
                                            :prop-class-id="fields.allotment_class_id"
                                            :prop-allotment-account="allotment.allotment"
                                            @browseAllotmentAccount="emitAllotmentAccount"></modal-browse-allotment-class-account>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Amount">
                                        <b-numberinput 
                                            v-models="fields.amount"
                                            :controls="false"
                                            step="0.0001">
                                        </b-numberinput>
                                    </b-field>
                                </div>
                            </div>


                            <div class="columns">
                                <div class="column">
                                    <b-field label="GADTC Priority Program">
                                        <modal-browse-priority-program
                                            :prop-priority-id="fields.priority_program_id"
                                            :prop-priority-program="priority_program.priority_program"
                                            @browsePriorityProgram="emitPriorityProgram"></modal-browse-priority-program>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Supplemental Budget">
                                        <b-input type="text" v-model="fields.supplemental_budget"
                                                 placeholder="Supplemental Budget"
                                                 required>
                                        </b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Capital Outlay">
                                        <b-input type="text" v-model="fields.capital_outlay"
                                                 placeholder="Capital Outlay"
                                                 required>
                                        </b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Accounts Payable">
                                        <b-input type="text" v-model="fields.accounts_payable"
                                                 placeholder="Accounts Payable"
                                                 required>
                                        </b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="TES Trust Fund">
                                        <b-input type="text" v-model="fields.tes_trust_fund"
                                                 placeholder="TES Trust Fund"
                                                 required>
                                        </b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Others">
                                        <b-input type="text" v-model="fields.others"
                                                 placeholder="Others">
                                        </b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="buttons mt-4">
                                <b-button
                                    @click="submit"
                                    icon-left="note-multiple-outline"
                                    class="button is-primary"
                                    label="Save Transaction">
                                </b-button>
                            </div>

                        </div> <!--body -->

                    </div> <!--box-->
                </div><!--col-->
            </div> <!--cols-->
        </div> <!--section-->
    </div> <!--root div -->
</template>

<script>



export default{


    data(){
        return {
            fields: {
                date_time: null,
                transaction_no: null,
                training_control_no : null,
                transaction_type_id: null,
                payee_id: null,
                payee: null,
                particulars: null,
                total_amount: null,
                documentary_attachments: [],
                allotment_class_id: null,
                allotment_class_account_id: null,
                allotment_class_account: null,
                allotment_class_account_code: null,
                amount: null,
                priority_program: null,
                pp_account_code: null,
                supplemental_budget: null,
                capital_outlay: null,
                accounts_payable: null,
                tes_trust_fund: null,
                others: null
            },

            errors: {},

            transactionTypes: [],

            global_id: 0,

            payee: {
                payee_id: 0,
                bank_account_payee: '',
            },
            allotment: {
                allotment: ''
            },
            priority_program: {
                priority_program: ''
            },

            documentaryAttachments: [],
            allotmentClasses: [],

        }
    },

    methods: {

        loadTransactionTypes(){
            axios.get('/load-transaction-types').then(res=>{
                this.transactionTypes = res.data
            })
        },

        loadDocumentaryAttachments(){
            axios.get('/load-documentary-attachments').then(res=>{
                this.documentaryAttachments = res.data
            }).catch(err=>{

            })
        },

        loadAllotmentClasses(){
            axios.get('/load-allotment-classes').then(res=>{
                this.allotmentClasses = res.data
            }).catch(err=>{

            })
        },


        emitPayee(row){
            this.payee.payee_id = row.payee_id
            this.payee.bank_account_payee = row.bank_account_payee
            this.fields.payee_id = row.payee_id
        },

        emitAllotmentAccount(row){
            this.allotment.allotment = '(' + row.allotment_class_account_code + ') ' + row.allotment_class_account
            this.fields.allotment_class_account_id = row.allotment_class_account_id
            this.fields.allotment_class_account = row.allotment_class_account
            this.fields.allotment_class_account_code = row.allotment_class_account_code
        },

        emitPriorityProgram(row){
            this.priority_program.priority_program = row.priority_program
            this.fields.priority_program_id = row.priority_program_id
            this.fields.priority_program = row.priority_program
            this.fields.priority_program_code = row.priority_program_code
        },


        //attaching documents
        newDocAttachment(){
            this.fields.documentary_attachments.push({
                documentary_attachment: '',
                image_upload: null
            })
        },
        removeDoctAttchment(ix){
            this.fields.documentary_attachments.splice(ix, 1)
        },



        submit: function(){
            //format the date
            console.log('fire')

            let formData = new FormData();
            formData.append('date_time', this.fields.date_time ? this.$formatDateAndTime(this.fields.date_time) : '');
            formData.append('transaction_no', this.fields.transaction_no ? this.fields.transaction_no : '');
            formData.append('training_control_no', this.fields.training_control_no ? this.fields.training_control_no : '');
            formData.append('transaction_type_id', this.fields.transaction_type_id ? this.fields.transaction_type_id : '');
            formData.append('payee_id', this.fields.payee_id ? this.fields.payee_id : '');
            formData.append('particulars', this.fields.particulars ? this.fields.particulars : '');
            formData.append('total_amount', this.fields.total_amount ? this.fields.total_amount : '');
            //doc attachment
            //will be code later

            formData.append('allotment_class_id', this.fields.allotment_class_id ? this.fields.allotment_class_id : '');
            formData.append('allotment_class_account_id', this.fields.allotment_class_account_id ? this.fields.allotment_class_account_id : '');
            formData.append('allotment_class_account', this.fields.allotment_class_account ? this.fields.allotment_class_account : '');
            formData.append('allotment_class_account_code', this.fields.allotment_class_account_code ? this.fields.allotment_class_account_code : '');
            
            formData.append('priority_program_id', this.fields.priority_program_id ? this.fields.priority_program_id : '');
            formData.append('priority_program', this.fields.priority_program ? this.fields.priority_program : '');
            formData.append('priority_program_code', this.fields.priority_program_code ? this.fields.priority_program_code : '');

            formData.append('supplemental_budget', this.fields.supplemental_budget ? this.fields.supplemental_budget : '');
            formData.append('capital_outlay', this.fields.capital_outlay ? this.fields.capital_outlay : '');
            formData.append('accounts_payable', this.fields.accounts_payable ? this.fields.accounts_payable : '');
            formData.append('tes_trust_fund', this.fields.tes_trust_fund ? this.fields.tes_trust_fund : '');
            formData.append('others', this.fields.others ? this.fields.others : '');


            if(this.global_id > 0){
                //update
                axios.put('/accounting/'+this.global_id, formData).then(res=>{
                    if(res.data.status === 'updated'){
                        this.$buefy.dialog.alert({
                            title: 'UPDATED!',
                            message: 'Successfully updated.',
                            type: 'is-success',
                            onConfirm: () => {
                                window.location = '/accounting'
                            }
                        })
                    }
                }).catch(err=>{
                    if(err.response.status === 422){
                        this.errors = err.response.data.errors;
                    }
                })
            }else{
                //INSERT HERE
                axios.post('/accounting', formData).then(res=>{
                    if(res.data.status === 'saved'){
                        this.$buefy.dialog.alert({
                            title: 'SAVED!',
                            message: 'Successfully saved.',
                            type: 'is-success',
                            confirmText: 'OK',
                            onConfirm: () => {
                                window.location = '/accounting'
                            }
                        })
                    }
                }).catch(err=>{
                    if(err.response.status === 422){
                        this.errors = err.response.data.errors;
                    }
                });
            }

        },

        refreshAccountAllotment(){
            this.allotment.allotment = null
            this.fields.allotment_class_account_id = null
            this.allotment_class_account = null
            this.allotment_class_account_code = null

        }


    },

    mounted(){
        this.loadTransactionTypes()
        this.loadDocumentaryAttachments()
        this.loadAllotmentClasses()
    }
}
</script>
