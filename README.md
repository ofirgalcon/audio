Audio module
==============

Provides the status of Audio devices.

Data can be viewed under the Audio Devices tab on the client details page or using the Audio list view.

Based on Thunderbolt module by tuxudo

Table Schema
---
* name - varchar(255) - Name of the Audio device
* default_audio_output - varchar(255) - Default output
* default_audio_input - varchar(255) - Default Input
* device_input - int(11) - Number of inputs
* device_output - int(11) - Number of outputs
* device_manufacturer - varchar(255) - Device manufacturer name
* device_srate - int(11) - Audio sample rate
* device_transport - varchar(255) - Transport
* input_source - varchar(255) - Active audio input
* output_source - varchar(255) - Active audio output