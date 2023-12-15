# Project README

## Description

This PHP project involves the creation and management of a database, with functionalities for inserting, displaying, and exporting data. The following sections provide an overview of the key features.

## Features

1. **Database Setup:**
    - A new database is created using SQL.
    - The user table is established within the database.

2. **Project Initialization:**
    - Upon opening the project, users are presented with three buttons: "Insert Data," "Display Data," and "Export Data."

3. **Insert Data:**
    - This functionality fetches data from Google Drive.
    - Columns are dynamically created using the initial data from the received data array.
    - The remaining data is added to the users table based on these columns.

4. **Display Data:**
    - Data is retrieved from the database.
    - It is presented in an HTML table with a built-in pagination feature.

5. **Export Data:**
    - Users input data into four fields.
    - The inputted data is used to search for relevant data in the database.
    - The found data can be exported to a CSV file.

## Usage

1. Clone the repository:

   ```bash
   git clone https://github.com/elmirabalasanyan11/scv-handler