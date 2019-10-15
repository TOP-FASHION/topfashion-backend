<#
.SYNOPSIS
    .
.DESCRIPTION
    Build a Docker image adding a layer to the official Wordpress image.
.PARAMETER env
    The environment, e.g., s, stage, p, prod
.PARAMETER name
    The name of the image, e.g., mysite
.PARAMETER tag
    The image tag, e.g., 4.9.5-1.0
.EXAMPLE
    C:\PS>
    ./docker-build.ps1 -e stage -n mysite -t 4.9.5-1.0
.NOTES
    Author: Jim Frenette
    Date:   May 4, 2018
#>

# Param needs to be at the top if not in a function
Param(

    [parameter(mandatory=$true,
    HelpMessage="Enter the environment, e.g., s, stage, p, prod")]
    [alias("e")]
    [String]
    $env,

    [parameter(mandatory=$true,
    HelpMessage="Enter the name of the image, e.g., mysite")]
    [alias("n")]
    [String]
    $name,

    [parameter(mandatory=$true,
    HelpMessage="Enter the image tag, e.g., 4.9.5-1.0")]
    [alias("t")]
    [String]
    $tag

) #end param

# set env to prod or stage
switch ($env.ToLower())
{
    "prod" {
        $env = $env
        break
    }
    "stage" {
        $env = $env
        break
    }
    "p" {
        $env = $env + "rod"
        break
    }
    "s" {
        $env = $env + "tage"
        break
    }
    default {
        Write-Host "invalid env parameter:" $env
        Write-Host "must be one of: p, prod, s, stage"
        exit
    }
}

# image
$IMAGE = $name + ':' + $tag

$CONFIRM = Read-Host "Build" $env.ToUpper() "Docker image:" $IMAGE "? [y/n]"

if ($CONFIRM.ToLower() -eq 'n') {exit}

$SRC = "wordpress"
$BUILD = "build"
$THEME = "mytheme"

# name:tag format required
# $IMAGE = "mysite:4.9.5-1.2"

# cleanup
Remove-Item .\$BUILD -Force -Recurse

# docker folders
New-Item -ItemType Directory -Force -path docker\prod
New-Item -ItemType Directory -Force -path docker\stage

# build folders
New-Item -ItemType Directory -path $BUILD
New-Item -ItemType Directory -path $BUILD\wp-content
New-Item -ItemType Directory -path $BUILD\wp-content\themes

if ( Test-Path $SRC\wp-content\plugins -PathType Container ) {
    Copy-Item -Path $SRC\wp-content\plugins -Recurse -Destination $BUILD\wp-content\plugins
}
if ( Test-Path $SRC\wp-content\themes\$THEME -PathType Container ) {
    Copy-Item -Path $SRC\wp-content\themes\$THEME -Recurse -Destination $BUILD\wp-content\themes\$THEME
}
if ( Test-Path $SRC\wp-content\uploads -PathType Container ) {
    Copy-Item -Path $SRC\wp-content\uploads -Recurse -Destination $BUILD\wp-content\uploads
}

# build files
if ( Test-Path $SRC\.htaccess -PathType Leaf ) {
    Copy-Item -Path $SRC\.htaccess -Destination $BUILD\.htaccess
}
Copy-Item -Path $SRC\*.html -Destination $BUILD\
Copy-Item -Path $SRC\*.txt -Destination $BUILD\
Copy-Item -Path $SRC\*.xml -Destination $BUILD\

## files (prod)
# if ($env -eq 'prod') {
#    if ( Test-Path $SRC\wp-content\themes\$THEME\footer_prod.php -PathType Leaf ) {
#       Copy-Item -Path $SRC\wp-content\themes\$THEME\footer_prod.php -Destination $BUILD\wp-content\themes\$THEME\footer.php -Verbose
#    }
# }

# build docker image
docker build --squash -f Dockerfile -t $IMAGE .

# save image
$TAR = $IMAGE -replace ":", "-"
docker save -o docker/$env/$TAR.tar $IMAGE
