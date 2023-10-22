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
                                        <b-datetimepicker v-model="fields.date_time"></b-datetimepicker>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Transaction No."
                                        :type="errors.transaction_no ? 'is-danger':''"
                                        :message="errors.transaction_no ? errors.transaction_no[0] : ''">
                                        <b-input type="text" placholder="Transaction No."
                                            v-model="fields.transaction_no">
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
                                            v-model="fields.training_control_no">
                                        </b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Transaction Type" expanded
                                        :type="errors.transaction_type ? 'is-danger':''"
                                        :message="errors.transaction_type ? errors.transaction_type[0] : ''">
                                        <b-select placholder="Transaction Type" expanded
                                            v-model="fields.transaction_type">
                                            <option :value="item.transaction_type_id" v-for="(item, index) in transactionTypes"
                                                :key="index">{{ item.transaction_type }}</option>
                                        </b-select>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Banck Account/Payee">
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
                                        <b-select v-model="fields.allotment_class_id" expanded>
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

                        </div> <!--body -->

                    </div> <!--box-->
                </div><!--col-->
            </div> <!--cols-->
        </div> <!--section-->
    </div> <!--root div -->
</template>

<script>


import ModalBrowseAllotmentClassAccount from "../../Modals/ModalBrowseAllotmentClassAccount.vue";

export default{
    components: {ModalBrowseAllotmentClassAccount},

    data(){
        return {
            fields: {
                date_time: null,
                transaction_no: '',
                training_control_no: '',
                transaction_type: '',
                payee_id: 0,
                payee: '',
                particulars: '',
                total_amount: 0,
                documentary_attachments: [],
                allotment_class_id: 0,

            },
            errors: {},

            transactionTypes: [],

            payee: {
                payee_id: 0,
                bank_account_payee: '',
            },
            allotment: {
                allotment: ''
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
            this.fields.account = row.allotment_class_account
            this.fields.account_code = row.allotment_class_account_code
        },



        newDocAttachment(){
            this.fields.documentary_attachments.push({
                documentary_attachment: '',
                image_upload: null
            })
        },
        removeDoctAttchment(ix){
            this.fields.documentary_attachments.splice(ix, 1)
        }
    },

    mounted(){
        this.loadTransactionTypes()
        this.loadDocumentaryAttachments()
        this.loadAllotmentClasses()
    }
}
</script>
