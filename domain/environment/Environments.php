<?php

namespace domain\environment;

enum Environments: string
{
    case DEVELOPMENT = "dev";
    case STAGING = "staging";
    case PRODUCTION = "prod";
}