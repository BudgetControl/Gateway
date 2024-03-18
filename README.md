# Budget Control Gateway

This is the Gateway component of the Budget Control application. It acts as an entry point for incoming requests and routes them to the appropriate microservices.

## Prerequisites

- Docker: [Install Docker](https://docs.docker.com/get-docker/)
- Task: [Install Task](https://taskfile.dev/#/installation)

## Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/your-username/budgetcontrol-gateway.git
    ```

2. Build and run the Docker containers:

    ```bash
    task build:dev
    ```

## Usage

To start the Gateway, run the following command:
Open your browser and visit [http://localhost:8081](http://localhost:8081) to access the BudgetControl application.

## Task Commands

- `task build:dev`: Install and build dev application.
- `task build`: Install and build base application.

## Contributing

Contributions are welcome! Please read our [Contribution Guidelines](CONTRIBUTING.md) for more information.

## License

This project is licensed under the [MIT License](LICENSE).