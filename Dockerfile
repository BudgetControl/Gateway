FROM node:18-alpine

# Set the working directory
WORKDIR /app

# Copy package files
COPY package*.json ./

# Install dependencies
RUN npm ci --only=production

# Copy the application files
COPY . .

# Create necessary directories and files
RUN mkdir -p logs
RUN touch .env

# Expose the port
EXPOSE 3000

# Start the server
CMD ["npm", "start"]
# End of Dockerfile
