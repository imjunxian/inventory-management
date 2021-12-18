import os
import tensorflow as tf
from tensorflow.keras import layers
from tensorflow.keras import Model
from tensorflow.python.keras.backend import set_session
from flask import Flask, request
from flask_cors import CORS
import cv2
import json
import numpy as np
import base64
from datetime import datetime