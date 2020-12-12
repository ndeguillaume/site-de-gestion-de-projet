#!/bin/bash
if grep -q failures=\"0\" $1
    then
        echo "All tests passed !"
    else 
        echo "Not all tests passed !"
        exit 1
fi