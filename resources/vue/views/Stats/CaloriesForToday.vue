<template>
    <b-col xl="3" md="6">
        <stats-card title="Calories For Today"
                    :type="gradientColor"
                    :sub-title="caloriesString"
                    icon="ni ni-active-40"
                    class="mb-4">

            <template slot="footer">
                <span class="mr-2" :class="limitTextColor">{{ limitPercent }}% (of {{ calorieLimit }})</span><br>
                <span class="text-nowrap" :class="limitTextColor">{{ limitExceeded ? 'The limit is exceeded' : `${caloriesLeft} kcal left of the limit` }}</span>
            </template>
        </stats-card>
    </b-col>
</template>

<script>
import statsRepository from "@/repositories/foodEntry/statsRepository";

export default {
    name: "CaloriesForToday",
    data() {
        return {
            limitExceeded: false,
            calories: null,
            calorieLimit: null,
        };
    },
    computed: {
        limitTextColor() {
            return this.limitExceeded ? 'text-warning' : 'text-success';
        },
        caloriesString() {
            return this.calories ? this.calories.toString() : '0';
        },
        gradientColor() {
            return this.limitExceeded ? 'gradient-red' : 'gradient-green';
        },
        limitPercent() {
            if (!this.calorieLimit) {
                return 0;
            }

            return Math.round(this.calories / this.calorieLimit * 10000) / 100;
        },
        caloriesLeft() {
            if (this.calories === null || this.calories >= this.calorieLimit) {
                return 0;
            }

            return Math.floor(this.calorieLimit - this.calories);
        }
    },
    methods: {
        getCaloriesForToday() {
            statsRepository.caloriesForToday().then(response => {
                this.limitExceeded = response.data.limit_exceeded;
                this.calories = response.data.calories_for_today;
                this.calorieLimit = response.data.calorie_limit;
            });
        }
    },
    mounted() {
        this.getCaloriesForToday()
        setInterval(this.getCaloriesForToday, 5000); //TODO make via websocket notification
    }
}
</script>

<style scoped>

</style>
