<template>
    <b-col xl="3" md="6">
        <stats-card title="Money spent this month"
                    :type="gradientColor"
                    :sub-title="moneyString"
                    icon="ni ni-active-40"
                    class="mb-4">

            <template slot="footer">
                <span class="mr-2" :class="limitTextColor">{{ limitPercent }}% (of $1000)</span><br>
                <span class="text-nowrap" :class="limitTextColor">{{ limitExceeded ? 'The money limit is exceeded' : `\$${moneyLimitLeft} left of the limit` }}</span>
            </template>
        </stats-card>
    </b-col>
</template>

<script>
import statsRepository from "@/repositories/foodEntry/statsRepository";

export default {
    name: "MoneySpent",
    data() {
        return {
            limitExceeded: null,
            money: null,
            monthlyLimit: null,
        };
    },
    computed: {
        limitTextColor() {
            return this.limitExceeded ? 'text-warning' : 'text-success';
        },
        moneyString() {
            return this.money ? this.money.toString() : '0';
        },
        gradientColor() {
            return this.limitExceeded ? 'gradient-red' : 'gradient-green';
        },
        limitPercent() {
            if (!this.monthlyLimit) {
                return 0;
            }

            return Math.round(this.money / this.monthlyLimit * 10000) / 100;
        },
        moneyLimitLeft() {
            if (this.money === null || this.money >= this.monthlyLimit) {
                return 0;
            }

            return Math.floor(this.monthlyLimit - this.money);
        }
    },
    methods: {
        getMonthlyMoneyLimit() {
            statsRepository.monthlyMoneyLimit().then(response => {
                this.limitExceeded = response.data.limit_exceeded;
                this.money = response.data.money;
                this.monthlyLimit = response.data.monthly_limit;
            });
        }
    },
    mounted() {
        this.getMonthlyMoneyLimit();
        setInterval(this.getMonthlyMoneyLimit, 5000);
    }
}
</script>

<style scoped>

</style>
