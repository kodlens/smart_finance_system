<template>
    <div>
        <div class="section">
            <div class="columns is-centered">
                <div class="column is-8-desktop is-10-tablet">
                    <div class="box">
                        <div class="has-text-weight-bold">ADD/EDIT RECORD</div>

                        <div class="mt-2">

                            <b-button
                                    @click="debug"
                                    icon-left="note-multiple-outline"
                                    class="button is-info"
                                    outlined
                                    label="Debug">
                                </b-button>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Date Time"
                                             :type="errors.date_time ? 'is-danger':''"
                                             :message="errors.date_time ? errors.date_time[0] : ''">
                                        <b-datetimepicker v-model="fields.date_time" required></b-datetimepicker>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Training Control No."
                                        :type="errors.training_control_no ? 'is-danger':''"
                                        :message="errors.training_control_no ? errors.training_control_no[0] : ''">
                                        <b-input type="text" placholder="Training Control No."
                                            v-model="fields.training_control_no" required>
                                        </b-input>
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
                                    <b-field label="Activity Date"
                                        :type="errors.activity_date ? 'is-danger':''"
                                        :message="errors.date_time ? errors.date_time[0] : ''">
                                        <b-datetimepicker v-model="fields.date_time" required></b-datetimepicker>
                                    </b-field>
                                </div>
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
                                    <b-field label="Supplier/Payee"
                                        :type="errors.payee_id ? 'is-danger':''"
                                        :message="errors.payee_id ? errors.payee_id[0] : ''">
                                        <modal-browse-payee
                                            @browsPayee="emitPayee"
                                            :prop-name="payee.bank_account_payee"></modal-browse-payee>
                                    </b-field>
                                </div>
                            </div>


                            <div class="columns">
                                <div class="column">
                                    <b-field label="Allotment Class" expanded
                                        :type="errors.allotment_class_id ? 'is-danger':''"
                                        :message="errors.allotment_class_id ? errors.allotment_class_id[0] : ''">
                                        <b-select v-model="fields.allotment_class_id"
                                            @input="refreshAccountAllotment" 
                                            expanded>
                                            <option v-for="(allot, ix) in allotmentClasses"
                                                :key="`allotclass${ix}`"
                                                :value="allot.allotment_class_id">{{ allot.allotment_class }}</option>
                                        </b-select>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Account"
                                        :type="errors.allotment_class_account_id ? 'is-danger':''"
                                        :message="errors.allotment_class_account_id ? errors.allotment_class_account_id[0] : ''">
                                        <modal-browse-allotment-class-account
                                            :prop-class-id="fields.allotment_class_id"
                                            :prop-allotment-account="allotment.allotment"
                                            @browseAllotmentAccount="emitAllotmentAccount"></modal-browse-allotment-class-account>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Amount"
                                        :type="errors.amount ? 'is-danger':''"
                                        :message="errors.amount ? errors.amount[0] : ''">
                                        <b-numberinput 
                                            v-model="fields.amount"
                                            :controls="false"
                                            step="0.0001">
                                        </b-numberinput>
                                    </b-field>
                                </div>
                            </div>


                            <div class="columns">
                                <div class="column">
                                    <b-field label="GADTC Priority Program"
                                        :type="errors.priority_program_id ? 'is-danger':''"
                                        :message="errors.priority_program_id ? errors.priority_program_id[0] : ''">
                                        <modal-browse-priority-program
                                            :prop-priority-program="priority_program.priority_program"
                                            @browsePriorityProgram="emitPriorityProgram"></modal-browse-priority-program>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Supplemental Budget"
                                        :type="errors.supplemental_budget ? 'is-danger':''"
                                        :message="errors.supplemental_budget ? errors.supplemental_budget[0] : ''">
                                        <b-input type="text" v-model="fields.supplemental_budget"
                                                 placeholder="Supplemental Budget"
                                                 required>
                                        </b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Capital Outlay"
                                        :type="errors.capital_outlay ? 'is-danger':''"
                                        :message="errors.capital_outlay ? errors.capital_outlay[0] : ''">
                                        <b-input type="text" v-model="fields.capital_outlay"
                                                 placeholder="Capital Outlay"
                                                 required>
                                        </b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Accounts Payable"
                                        :type="errors.account_payable ? 'is-danger':''"
                                        :message="errors.account_payable ? errors.account_payable[0] : ''">
                                        <b-input type="text" v-model="fields.account_payable"
                                            placeholder="Accounts Payable"
                                            required>
                                        </b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="TES Trust Fund"
                                        :type="errors.tes_trust_fund ? 'is-danger':''"
                                        :message="errors.tes_trust_fund ? errors.tes_trust_fund[0] : ''">
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
                            
                            <div class="columns">
                                <div class="column">
                                    <modal-browse-office
                                        label="Office"
                                        :status-type="errors.office_id ? 'is-danger':''"
                                        :message="errors.office_id ? errors.office_id[0] : ''"
                                        @browseOffice="emitBrowseOffice"
                                        :prop-name="office.office"
                                    ></modal-browse-office>
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
import { toSJIS } from '@chenfengyuan/vue-qrcode'




export default{

    props: {
        id: {
            type: Number,
            default: 0
        }
    },


    data(){
        return {
            fields: {
                date_time: null,
             
                training_control_no : null,
                particulars: null,
                activity_date: null,
                total_amount: null,

                payee_id: null,
                payee: null,

                allotment_class_id: null,
                allotment_class_account_id: null,
                allotment_class_account: null,
                allotment_class_account_code: null,

                amount: null,
                priority_program: null,
                priority_program_code: null,

                supplemental_budget: null,
                capital_outlay: null,
                account_payable: null,
                tes_trust_fund: null,
                others: null,
                office_id: null
            },

            errors: {},


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

            office: {
                office: ''
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

        emitBrowseOffice(row){
            this.office.office = row.office + ` (${row.description})`
            this.fields.office_id = row.office_id
            this.fields.office = row.office
        },


        //attaching documents
        newDocAttachment(){
            this.fields.documentary_attachments.push({
                documentary_attachment_id: 0,
                file_upload: null
            })
        },
        removeDoctAttchment(ix){
            this.$buefy.dialog.confirm({
                title: 'DELETE?',
                message: 'Are you sure you want to remove this attachment? This cannot be undone.',

                onConfirm: ()=>{
                    let nId = this.fields.documentary_attachments[ix].acctg_doc_attachment_id;

                    if(nId > 0){
                        axios.delete('/accounting/' + nId).then(res=>{
                            if(res.data.status === 'deleted'){
                                this.$buefy.toast.open({
                                    message: `Attachment deleted successfully.`,
                                    type: 'is-primary'
                                })
                            }
                        });
                    }

                    this.fields.documentary_attachments.splice(ix, 1)

                }
            });
       
        },



        submit: function(){
            //format the date

            let formData = new FormData();
            formData.append('date_time', this.fields.date_time ? this.$formatDateAndTime(this.fields.date_time) : '');
           
            formData.append('training_control_no', this.fields.training_control_no ? this.fields.training_control_no : '');
            formData.append('particulars', this.fields.particulars ? this.fields.particulars : '');

            formData.append('activity_date', this.fields.date_time ? this.$formatDate(this.fields.activity_date) : '');
            formData.append('total_amount', this.fields.total_amount ? this.fields.total_amount : '');
         
            formData.append('payee_id', this.fields.payee_id ? this.fields.payee_id : '');

            formData.append('allotment_class_id', this.fields.allotment_class_id ? this.fields.allotment_class_id : '');
            formData.append('allotment_class_account_id', this.fields.allotment_class_account_id ? this.fields.allotment_class_account_id : '');

            formData.append('allotment_class_account', this.fields.allotment_class_account ? this.fields.allotment_class_account : '');
            formData.append('allotment_class_account_code', this.fields.allotment_class_account_code ? this.fields.allotment_class_account_code : '');
            
            formData.append('amount', this.fields.amount ? this.fields.amount : '');
            
            formData.append('priority_program_id', this.fields.priority_program_id ? this.fields.priority_program_id : '');
            formData.append('priority_program', this.fields.priority_program ? this.fields.priority_program : '');
            formData.append('priority_program_code', this.fields.priority_program_code ? this.fields.priority_program_code : '');

            formData.append('supplemental_budget', this.fields.supplemental_budget ? this.fields.supplemental_budget : '');
            formData.append('capital_outlay', this.fields.capital_outlay ? this.fields.capital_outlay : '');
            formData.append('account_payable', this.fields.account_payable ? this.fields.account_payable : '');
            formData.append('tes_trust_fund', this.fields.tes_trust_fund ? this.fields.tes_trust_fund : '');
            formData.append('others', this.fields.others ? this.fields.others : '');
            formData.append('office_id', this.fields.office_id ? this.fields.office_id : '');


            if(this.id > 0){
                //update
                axios.post('/budgeting/'+this.id, formData).then(res=>{
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
                axios.post('/budgeting', formData).then(res=>{
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

                        this.$buefy.dialog.alert({
                            type: 'is-danger',
                            title: 'EMPTY FIELDS.',
                            message: 'Please fill out all required fields.'
                        })
                    }
                });
            }

        },

        refreshAccountAllotment(){
            this.allotment.allotment = null
            this.fields.allotment_class_account_id = null
            this.allotment_class_account = null
            this.allotment_class_account_code = null

        },



        debug(){

            this.fields.date_time = new Date();

            this.fields.training_control_no = 'TD-1234-22-1122'
            this.fields.particulars = 'Sample particulars'
            this.fields.activity_date = new Date();
            this.fields.total_amount = 10000


            this.fields.payee_id = 1
            
            this.fields.allotment_class_id = 1
            this.fields.allotment_class_account_id = 1

            this.fields.amount = 12000


            this.fields.supplemental_budget = 'sample supplemental'
            this.fields.capital_outlay = 'sample capital outlay'
            this.fields.account_payable = 'sample ap'
            this.fields.tes_trust_fund = 'tes trust fund'
            this.fields.others = 'sample others'
          
        },




        getData(){

            axios.get('/accounting/' + this.id).then(res=>{
                const result = res.data

                this.fields.date_time = new Date(result.date_time)
                this.fields.training_control_no = result.training_control_no
                this.fields.particulars = result.particulars


                this.fields.activity_date = new Date(result.activity_date)
                this.fields.total_amount = Number(result.total_amount)

                this.payee.bank_account_payee = result.payee.bank_account_payee
                this.fields.payee_id = result.payee_id
                

            
                this.fields.allotment_class_id = result.allotment_class_id

                //for display
                this.allotment.allotment = '(' + result.allotment_class.allotment_class_account_code + ') ' + result.allotment_class_account
                this.fields.allotment_class_account_id = result.allotment_class_account_id
               
                this.fields.amount = Number(result.amount)

                this.priority_program.priority_program = result.priority_program
                this.fields.priority_program_id = result.priority_program_id
                this.fields.priority_program = result.priority_program
                this.fields.priority_program_code = result.priority_program_code


                this.fields.supplemental_budget = result.supplemental_budget
                this.fields.capital_outlay = result.capital_outlay
                this.fields.account_payable = result.account_payable
                this.fields.tes_trust_fund = result.tes_trust_fund
                this.fields.others = result.others
                this.fields.office_id = result.office_id

            })
        }


    },

    mounted(){

        // if(this.id > 0){
        //     this.getData()
        // }


        this.loadAllotmentClasses()
    }
}
</script>
