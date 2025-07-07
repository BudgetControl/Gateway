const queryFilters = process.env.APP_QUERY_FILTERS ? process.env.APP_QUERY_FILTERS.split(',') : [];

module.exports = {
    core: process.env.CORE_API_BASE_URL,
    workspace: process.env.WORKSPACE_API_BASE_URL,
    auth: process.env.AUTH_API_BASE_URL,
    stats: process.env.STATS_API_BASE_URL,
    budget: process.env.BUDGETS_API_BASE_URL,
    searchengine: process.env.SEARCH_ENGINE_API_BASE_URL,
    wallet: process.env.WALLET_API_BASE_URL,
    entry: process.env.ENTRY_API_BASE_URL,
    debt: process.env.DEBT_API_BASE_URL,
    label: process.env.LABEL_API_BASE_URL,
    savings: process.env.SAVINGS_API_BASE_URL,
    config: {
        query_filters: queryFilters
    }
};
