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
                            <div class="">USED BUDGET: {{ ProcurementUsedBudget | numberWithCommas }}</div>

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