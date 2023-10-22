<template>
    <div>
        <div class="section">
            <div class="columns is-centered">
                <div class="column is-8">
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
                                    <b-field label="Transaction Type"
                                        :type="errors.transaction_type ? 'is-danger':''"
                                        :message="errors.transaction_type ? errors.transaction_type[0] : ''">
                                        <b-select placholder="Transaction Type" 
                                            v-model="fields.transaction_type">
                                            <option :value="item.transaction_type_id" v-for="(item, index) in transactionTypes"
                                                :key="index">{{ item.transaction_type }}</option>
                                        </b-select>
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

export default{
    data(){
        return {
            fields: {},
            errors: {},
        }
    },

    methods: {

    },

    mounted(){

    }
}
</script>