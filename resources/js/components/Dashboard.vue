<template>
    <div>

        <div class="section">

            <div class="columns is-centered">
                <div class="column is-8">

                    <div class="columns">
                        <div class="column">
                            <b-field label="Financial Year"
                                expanded>
                                <b-select v-model="search.financial_year" expanded
                                    @input="loadData"
                                    placeholder="Financial Year">
                                    <option v-for="(item, indx) in financialYears"
                                        :key="`fy${indx}`"
                                        :value="{ 
                                            financial_year_id: item.financial_year_id,
                                            financial_budget: item.financial_budget,
                                            balance: item.balance
                                        }">
                                        {{ item.financial_year_code }}
                                        -
                                        {{ item.financial_year_desc }}
                                    </option>
                                </b-select>
                            </b-field>
                        </div>
                    </div>

                    <div class="columns">
                        <div class="column">
                            <div>
                                FINANCIAL YEAR BUDGET: {{ search.financial_year['financial_budget'] | numberWithCommas }}
                            </div>
                            <div>
                                BALANCE: {{ search.financial_year['balance'] | numberWithCommas}}
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="columns">
                        <div class="column">
                            <div class="has-text-weight-bold">ACCOUNTING</div>
                            <div class="">USED BUDGET: {{ accountingUsedBudget | numberWithCommas }}</div>


                            <b-field label="Allotment Class" label-position="on-border"
                                expanded>
                                <b-select v-model="search.allotment_accounting"
                                    @input="loadAllotmentAccounting"
                                    expanded>
                                    <option v-for="(allot, ix) in allotmentClasses"
                                        :key="`allotclass${ix}`"
                                        :value="allot.allotment_class_id">{{ allot.allotment_class }}</option>
                                </b-select>
                            </b-field>

                            <div>
                                <table class="table">
                                    <tr>
                                        <th>Allotment Class</th>
                                        <th>Allotment Account</th>
                                        <th>Allotment Budget</th>
                                        <th>Financial Budget</th>
                                        <th>Amount</th>
                                    </tr>
                                    <tr v-for="(item, index) in allotmentAccounting" :key="`allotment${index}`">
                                        <td>
                                            {{ item.allotment_class }}
                                        </td>
                                        <td>
                                            {{ item.allotment_class_account }}
                                        </td>
                                        <td>
                                            {{ item.allotment_class_budget | numberWithCommas }}
                                        </td>
                                        <td>
                                            {{ item.financial_budget | numberWithCommas }}
                                        </td>
                                        <td>
                                            {{ item.amount | numberWithCommas }}
                                        </td>
                                    </tr>
                                </table>
                               
                            </div>

                        </div>
                    </div>

                    <hr>

                    <div class="columns">
                        <div class="column">
                            <div class="has-text-weight-bold">BUDGETING</div>
                            <div class="">USED BUDGET: {{ budgetingUsedBudget | numberWithCommas }}</div>

                        </div>
                    </div>

                    <hr>

                    <div class="columns">
                        <div class="column">
                            <div class="has-text-weight-bold">PROCUREMENT</div>
                            <div class="">USED BUDGET: {{ procurementUsedBudget | numberWithCommas }}</div>

                        </div>
                    </div>

                    <hr>

                    <div class="columns">
                        <div class="column">
                            <div class="has-text-weight-bold is-size-4">TOTAL: {{ totalUtilizations | numberWithCommas }}</div>
                    
                        </div>
                    </div>


                </div> <!--col-->
            </div><!--cols-->
        </div>
    </div>
</template>

<script>
export default{

    data(){
        return{
            search: {
               financial_year: {
                    financial_year_id: null,
                    financial_budget: null,
                    balance: null
               }
            },

            financialYears: [],

            accountingUtilizations: [],


            accountingUsedBudget: 0,
            budgetingUsedBudget: 0,
            procurementUsedBudget: 0,

            allotmentClasses: [],

            allotmentAccounting: [],
        }
    },

    methods: {

        loadFinancialYears(){
            axios.get('/load-financial-years').then(res=>{
                this.financialYears = res.data
            })
        },

        loadData(){
            this.loadAccountingUtilizations()
            this.loadBudgetingUtilizations()
            this.loadProcurementUtilizations()
            this.loadAllotmentClasses()
        },

        loadAccountingUtilizations(){
            axios.get('/load-accounting-utilizations/' + this.search.financial_year['financial_year_id']).then(res=>{
                this.accountingUsedBudget = res.data
            })
        },

        loadBudgetingUtilizations(){
            axios.get('/load-budgeting-utilizations/' + this.search.financial_year['financial_year_id']).then(res=>{
                this.budgetingUsedBudget = res.data
            })
        },

        loadProcurementUtilizations(){
            axios.get('/load-procurement-utilizations/' + this.search.financial_year['financial_year_id']).then(res=>{
                this.procurementUsedBudget = res.data
            })
        },


        async loadAllotmentClasses(){
            await axios.get('/load-allotment-classes-by-financial/' + this.search.financial_year['financial_year_id']).then(res=>{
                this.allotmentClasses = res.data
            }).catch(err=>{

            })
        },





        ///////////
        loadAllotmentAccounting(){
        axios.get('/load-allotment-accounting/' + this.search.financial_year['financial_year_id'] + '/' + this.search.allotment_accounting).then(res=>{
            this.allotmentAccounting = res.data
        })
        }
    },

    mounted(){
        this.loadFinancialYears()
    },

    computed: {
        totalUtilizations(){
            return this.accountingUsedBudget + this.budgetingUsedBudget + this.procurementUsedBudget
        }
    }

}

</script>