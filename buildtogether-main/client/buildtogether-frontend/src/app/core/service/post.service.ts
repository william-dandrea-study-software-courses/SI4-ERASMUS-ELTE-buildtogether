import { Injectable } from '@angular/core';
import {Post} from "../../shared/models/post.model";
import {BehaviorSubject} from "rxjs";
import {User} from "../../shared/models/user.model";
import {HttpClient} from "@angular/common/http";
import {GET_ALL_POSTS} from "../../../assets/routes.constants";

@Injectable({
  providedIn: 'root'
})
export class PostService {

  public allPosts: Post[] | null = null;
  public allPosts$: BehaviorSubject<Post[] | null> = new BehaviorSubject<Post[] | null>(null)


  constructor(private http: HttpClient) {
    this.initializeAllPosts();

  }


  private initializeAllPosts(): void {
    this.http.get<Post[]>(GET_ALL_POSTS).subscribe(
      data => {
        this.allPosts = data;
        this.allPosts$.next(this.allPosts)
      },
        error => {
        console.log(error)
    })
  }


}
