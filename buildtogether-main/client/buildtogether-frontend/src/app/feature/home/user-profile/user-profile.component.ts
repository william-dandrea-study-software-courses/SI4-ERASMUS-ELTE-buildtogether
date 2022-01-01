import { Component, OnInit, Output, EventEmitter, OnChanges } from '@angular/core';
import { MatChipInputEvent } from '@angular/material/chips';
import {COMMA, ENTER} from '@angular/cdk/keycodes';
import { UserService } from 'src/app/core/service/user.service';
import { User } from 'src/app/shared/models/user.model';
import { Interest } from 'src/app/shared/models/interest.model';
import {FormControl, Validators} from '@angular/forms';
import { InterestService } from 'src/app/core/service/interest.service';


@Component({
  selector: 'app-user-profile',
  templateUrl: './user-profile.component.html',
  styleUrls: ['./user-profile.component.scss']
})

export class UserProfileComponent implements OnInit {
  @Output() save = new EventEmitter<User>();
  selectable = true;
  removable = true;
  addOnBlur = true;
  readonly separatorKeysCodes = [ENTER, COMMA] as const;
  interests: Interest[] = [];
  longText = `Experienced Frontend engineer with interest in data science, have more than four years of working in web projects.`;
  isEdit : boolean =false;
  user: User;

  add(event: MatChipInputEvent): void {
    const value = (event.value || '').trim();

    // Add our interest
    if (value) {
      this.interests.push({id: this.interests.length + 1 , tag: value});
    }

    // Clear the input value
    event.chipInput!.clear();
  }

  remove(interest: Interest): void {
    const index = this.interests.indexOf(interest);

    if (index >= 0) {
      this.interests.splice(index, 1);
    }
  }

  email = new FormControl('', [Validators.required, Validators.email]);

  getErrorMessage() {
    if (this.email.hasError('required')) {
      return 'You must enter a value';
    }

    return this.email.hasError('email') ? 'Not a valid email' : '';
  }
  constructor(private userService: UserService, private interestService: InterestService) { }

  async ngOnInit(): Promise<void> {
    this.user=await this.userService.getUser();
    this.interests=await this.interestService.getUserInterests(this.user.id);
  }

  async onSubmit(): Promise<void> {
    this.isEdit= false;
    this.user=await this.userService.updateUser(this.user.id, this.user)
  }

}
